<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Log::info("PUT - /user/$id - Update the specified user in storage");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Update the specified user in storage'
            ],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \Log::info("DELETE - /user/$id - Remove the specific user from storage");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Remove the specific user from storage'
            ],
            204
        );
    }

    /**
     * Display a list of a user's favorite products.
     */
    public function indexFavorite(string $id)
    {
        \Log::info("GET - /user/$id/favorite - Display a list of a user's favorite products");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a list of a user\'s favorite products'
            ],
            200
        );
    }

    /**
     * Store a new favorite product.
     */
    public function storeFavorite(Request $request, string $userId, string $productId)
    {
        \Log::info("POST - /user/$userId/favorite/$productId - Store a new favorite product");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a new favorite product'
            ],
            201
        );
    }

    /**
     * Remove the specified favorite product.
     */
    public function destroyFavorite(string $userId, string $productId)
    {
        \Log::info("DELETE - /user/$userId/favorite/$productId - Remove the specific favorite product");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Remove the specific favorite product'
            ],
            204
        );
    }

    /**
     * Display a list of a user's orders.
     */
    public function indexOrders(string $id)
    {
        \Log::info("GET - /user/$id/orders - Display a list of a user's orders");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a list of a user\'s orders'
            ],
            200
        );
    }

    /**
     * Display a list of a user's comments.
     */
    public function indexComments(string $id)
    {
        \Log::info("GET - /user/$id/comments - Display a list of a user's comments");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a list of a user\'s comments'
            ],
            200
        );
    }
}
