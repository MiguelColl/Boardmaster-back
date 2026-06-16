<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\ProductModel;
use App\Services\Elasticsearch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    /**
     * Search products by query params
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ProductCollection
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $page = $request->get('page', 1);
        $parseSearch = str_replace(' ', '_', strtolower(trim($q)));

        try {
            $products = $this->searchElastic($q, $page);
        } catch (Exception $e) {
            \Log::error('[ElasticSearch ERROR] ' . $e->getMessage());
            $products = $this->searchBBDD($q);
        }

        return Cache::remember("search_$parseSearch" . "_$page", config('constants.cache.short'), function () use ($products) {
            return new ProductCollection($products);
        });
    }

    /**
     * Search in ElasticSearch
     * @param string $value
     * @param int $page
     * @return LengthAwarePaginator
     */
    private function searchElastic($value, $page)
    {
        $elements = app(Elasticsearch::class)->search($value, $page, new ProductModel());

        $ids = Arr::pluck($elements['hits']['hits'], '_id');
        $total = $elements['hits']['total']['value'];

        $products = ProductModel::loadRelations()
            ->active()
            ->findMany($ids)
            ->sortBy(function ($model) use ($ids) {
                return array_search($model->getKey(), $ids);
            });

        return new LengthAwarePaginator(
            $products,
            $total,
            config('constants.pagination'),
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    /**
     * Search in BBDD
     * @param string $value
     * @return LengthAwarePaginator
     */
    private function searchBBDD($value)
    {
        return ProductModel::search($value)
            ->loadRelations()
            ->active()
            ->paginate(config('constants.pagination'));
    }
}
