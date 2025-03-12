<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductModel::with(['variants' => function ($q) {
            $q->with(['stock', 'rate'])->active();
        }])->active()
            ->orderBy('id')
            ->paginate(20);

        return new ProductCollection($products);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductModel::where('id', $id)
            ->with('variants', function ($q) {
                $q->with(['stock', 'rate'])->active();
            })->active()
            ->first();

        return $product ? new ProductResource($product) : abort(404);
    }

    /**
     * Display a product model by a given url.
     */
    public function showByUrl(Request $request)
    {
        $url = $request->post('url', '');

        if (!$url) {
            // return response()->json(
            //     [
            //         'error' => true,
            //         'message' => 'Not valid url'
            //     ],
            //     400
            // );
            abort(400);
        }

        $product = ProductModel::where('url', $url)
            ->with('variants', function ($q) {
                $q->with(['stock', 'rate'])->active();
            })->active()
            ->first();

        return $product ? new ProductResource($product) : abort(404);
    }

    /**
     * Display a listing of the product model comments.
     */
    public function indexComment(string $id)
    {
        \Log::info("GET - /model/$id/comment - Display a listing of the product model comments");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a listing of the product model comments'
            ],
            200
        );
    }

    /**
     * Store a product model comment.
     */
    public function storeComment(string $id)
    {
        \Log::info("POST - /model/$id/comment - Store a product model comment");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a product model comment'
            ],
            201
        );
    }

    public function filterNewProducts()
    {
        $products = ProductModel::filterByNews()->active()->get();
        return response()->json(
            [
                'error' => false,
                'data' => $products,
            ],
            201
        );
    }
}
