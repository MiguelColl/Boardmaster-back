<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cart = CartService::getCart();
        return new CartResource($cart->loadRelations());
    }

    /**
     * Store a product in the cart.
     */
    public function storeProduct(Request $request, string $id)
    {
        $qty = $request->post('qty', 0);
        $increment = $request->post('increment') ? true : false;
        $cart = CartService::addOrUpdateProduct($id, $qty, $increment);
        return new CartResource($cart->loadRelations());
    }

    /**
     * Remove all product lines of a cart.
     */
    public function destroyCartLines()
    {
        $cart = CartService::clearCart();
        return new CartResource($cart);
    }

    /**
     * Store a new coupon.
     */
    public function storeCoupon(Request $request, string $code)
    {
        $cart = CartService::addCoupon($code);
        return new CartResource($cart->loadRelations());
    }

    /**
     * Remove a specific coupon.
     */
    public function destroyCoupon()
    {
        $cart = CartService::removeCoupon();
        return new CartResource($cart->loadRelations());
    }
}
