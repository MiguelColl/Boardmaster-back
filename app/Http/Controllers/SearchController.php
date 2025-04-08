<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\ProductModel;
use App\Services\Elasticsearch;
use Illuminate\Http\Request;
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
        $search = $request->get('q');
        $parseSearch = str_replace(' ', '_', strtolower($search));

        return Cache::remember("search_$parseSearch", config('constants.cache.short'), function () use ($search) {
            $products = ProductModel::search($search)
                ->loadRelations()
                ->active()
                ->paginate(config('constants.pagination'));

            return new ProductCollection($products);
        });

        // $q = $request->get('q') ?: '';

        // $elements = app(Elasticsearch::class)->search($q, new ProductModel());

        // $ids = Arr::pluck($elements['hits']['hits'], '_id');

        // return ProductModel::findMany($ids)
        //     ->sortBy(function ($model) use ($ids) {
        //         return array_search($model->getKey(), $ids);
        //     });
    }
}
