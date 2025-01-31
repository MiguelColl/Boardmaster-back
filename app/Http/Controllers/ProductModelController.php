<?php

namespace App\Http\Controllers;

class ProductModelController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        \Log::info("GET - /model/$id - Display the specified model");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display the specified model'
            ],
            200
        );
    }

    /**
     * Display a product model by a given url.
     */
    public function showByUrl()
    {
        \Log::info('POST - /model/byUrl - Display a product model by a given url');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a product model by a given url'
            ],
            200
        );
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
}
