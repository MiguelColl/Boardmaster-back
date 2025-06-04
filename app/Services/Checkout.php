<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Events\CreatedOrder;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Stock;
use App\Models\User;
use App\Rules\EmailAlias;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class Checkout
{
    public static function placeOrder(Request $request, $cart)
    {
        $user = isset($request->create_user) && $request->create_user && !Auth::check() ? self::createUser($request) : Auth::user();

        $order = Order::create(self::processOrderData($request, $cart, $user));

        foreach ($cart->lines as $line) {
            OrderLine::create(self::processLineData($order->id, $line));

            $line->update([
                'active' => false,
            ]);

            Stock::where('product_variant_id', $line->variant->id)
                ->decrement('stock', $line->units);
        }

        $cart->update([
            'active' => false,
            'order_id' => $order->id,
        ]);

        event(new CreatedOrder($order));

        return $order;
    }

    public static function checkStock($cart)
    {
        $productsWithoutStock = [];

        foreach ($cart->lines as $line) {
            $stock = Stock::where('product_variant_id', $line->variant->id)
                ->lockForUpdate()
                ->first();

            if (!$stock || $stock->stock < $line->units) {
                $productsWithoutStock[$line->variant->id] = $line->variant->stock->stock;
            }
        }

        return (object) [
            'error' => !empty($productsWithoutStock),
            'message' => 'There are products in yout cart out of stock.',
            'products' => $productsWithoutStock,
        ];
    }

    public static function validateFields(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Auth::check() ? 'exists:' . User::class : 'unique:' . User::class,
                new EmailAlias(),
            ],
            'delivery_name' => ['required', 'string', 'max:255'],
            'delivery_surname' => ['required', 'string', 'max:255'],
            'delivery_address' => ['required', 'string', 'max:255'],
            'delivery_zipcode' => ['required', 'regex:/^[0-9]{5}$/'],
            'delivery_province' => ['required', 'string', 'max:255'],
            'delivery_country' => ['required', 'string', 'max:255'],
            'delivery_phone' => ['required', 'regex:/^(\+\d{1,4}\s?)?[6789]\d{2}\s?\d{3}\s?\d{3}$/'],
            'delivery_comments' => ['sometimes', 'string'],
            'bill_name' => ['sometimes', 'string', 'max:255'],
            'bill_surname' => ['sometimes', 'string', 'max:255'],
            'bill_address' => ['sometimes', 'string', 'max:255'],
            'bill_zipcode' => ['sometimes', 'regex:/^[0-9]{5}$/'],
            'bill_province' => ['sometimes', 'string', 'max:255'],
            'bill_country' => ['sometimes', 'string', 'max:255'],
            'bill_identity_card' => ['sometimes', 'string'],
            'bill_fiscal_name' => ['sometimes', 'string'],
            'payment_method' => ['required'],
            'create_user' => ['sometimes', 'boolean'],
        ]);
    }

    private static function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->delivery_name,
            'email' => $request->email,
            'password' => Str::random(40),
        ]);

        if ($user) {
            (new PasswordResetLinkController())->store($request);
        }

        return $user;
    }

    private static function processOrderData(Request $request, $cart, $user)
    {
        return [
            'user_id' => $user?->id,
            'unique_id' => Str::uuid()->toString(),
            'email' => $request->email,
            'delivery_name' => $request->delivery_name,
            'delivery_surname' => $request->delivery_surname,
            'delivery_address' => $request->delivery_address,
            'delivery_zipcode' => $request->delivery_zipcode,
            'delivery_province' => $request->delivery_province,
            'delivery_country' => $request->delivery_country,
            'delivery_phone' => $request->delivery_phone,
            'delivery_comments' => $request->delivery_comments,
            'bill_name' => isset($request->bill_name) ? $request->bill_name : $request->delivery_name,
            'bill_surname' => isset($request->bill_surname) ? $request->bill_surname : $request->delivery_surname,
            'bill_address' => isset($request->bill_address) ? $request->bill_address : $request->delivery_address,
            'bill_zipcode' => isset($request->bill_zipcode) ? $request->bill_zipcode : $request->delivery_zipcode,
            'bill_province' => isset($request->bill_province) ? $request->bill_province : $request->delivery_province,
            'bill_country' => isset($request->bill_country) ? $request->bill_country : $request->delivery_country,
            'bill_identity_card' => isset($request->bill_identity_card) ? $request->bill_identity_card : null,
            'bill_fiscal_name' => isset($request->bill_fiscal_name) ? $request->bill_fiscal_name : null,
            'payment_method' => $request->payment_method,
            'paid' => true,
            'paid_at' => Carbon::now(),
            'total_price' => $cart->total_price,
            'tax_price' => $cart->taxes,
            'subtotal_price' => $cart->subtotal_price,
            'shipping_price' => $cart->shipment,
            'shipping_tax' => round($cart->shipment - ($cart->shipment / (config('constants.iva') + 1)), 2),
            'discounted_price' => $cart->discount,
            'coupon_id' => $cart->coupon?->id,
            'status' => OrderStatus::PAID->value,
        ];
    }

    private static function processLineData($orderId, $line)
    {
        return [
            'product_variant_id' => $line->product_variant_id,
            'order_id' => $orderId,
            'sku' => $line->variant->sku,
            'units' => $line->units,
            'name' => $line->variant->model->name,
            'price_unit' => $line->price_per_unit,
            'price_unit_base' => $line->base_price_per_unit,
            'price_total' => $line->total_price,
            'price_total_base' => $line->total_base_price,
            'original_price' => $line->variant->rate->price,
            'tax_value' => config('constants.iva'),
            'tax_unit' => $line->tax_per_unit,
            'tax_total' => $line->total_tax,
            'color' => $line->variant->color,
            'image' => $line->variant->images[0],
        ];
    }
}
