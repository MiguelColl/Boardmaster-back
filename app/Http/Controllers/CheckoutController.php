<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\OrderResource;
use App\Services\CartService;
use App\Services\Checkout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Checkout::validateFields($request);

        $cart = CartService::getCart();
        $cart->load(['lines.variant' => ['model', 'rate', 'stock'], 'coupon']);

        if ($cart->lines->isEmpty()) {
            abort(400, 'There are no products in your cart');
        }

        try {
            DB::beginTransaction();

            $checkStock = Checkout::checkStock($cart);
            if ($checkStock->error) {
                DB::rollBack();
                return (new ErrorResource($checkStock))->response()->setStatusCode(400);
            }

            $order = Checkout::placeOrder($request, $cart);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('[ORDER] Error processing order: ' . $e->getMessage());
            abort(500, 'An error ocurred while processing your order, please try again later.');
        }

        return new OrderResource($order);
    }
}
