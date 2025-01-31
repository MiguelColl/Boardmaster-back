<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Services\Elasticsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    /**
     * Search products by query params
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection<int, mixed>
     */
    public function search(Request $request)
    {
        \Log::info('POST - /search - Search products by query params');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Search products by query params'
            ],
            200
        );

        // $q = $request->get('q') ?: '';

        // $elements = app(Elasticsearch::class)->search($q, new ProductModel());

        // $ids = Arr::pluck($elements['hits']['hits'], '_id');

        // return ProductModel::findMany($ids)
        //     ->sortBy(function ($model) use ($ids) {
        //         return array_search($model->getKey(), $ids);
        //     });
    }
}
