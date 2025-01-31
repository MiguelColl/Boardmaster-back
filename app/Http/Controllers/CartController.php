<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('POST - /cart - Store a newly created cart in storage');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a newly created cart in storage'
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        \Log::info("GET - /cart/$id - Display the specified cart");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display the specified cart'
            ],
            200
        );
    }

    /**
     * Store a product in the cart.
     */
    public function storeProduct(Request $request, string $id)
    {
        \Log::info("POST - /cart/$id/product - Store a product in the cart");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a product in the cart'
            ],
            201
        );
    }

    /**
     * Update a specific product in the cart.
     */
    public function updateProduct(Request $request, string $id)
    {
        \Log::info("PUT - /cart/$id/product - Update a specific product in the cart");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Update a specific product in the cart'
            ],
            201
        );
    }

    /**
     * Remove a specific product line of a cart.
     */
    public function destroyProductLine(string $cartId, string $lineId)
    {
        \Log::info("DELETE - /cart/$cartId/line/$lineId - Remove a specific product line of a cart");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Remove a specific product line of a cart'
            ],
            204
        );
    }

    /**
     * Store a new coupon.
     */
    public function storeCoupon(Request $request, string $id)
    {
        \Log::info("POST - /cart/$id/coupon - Store a new coupon");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a new coupon'
            ],
            201
        );
    }

    /**
     * Remove a specific coupon.
     */
    public function destroyCoupon(string $id)
    {
        \Log::info("DELETE - /cart/$id/coupon - Remove a specific coupon");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Remove a specific coupon'
            ],
            204
        );
    }
}
