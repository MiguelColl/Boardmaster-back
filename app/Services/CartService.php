<?php

namespace App\Services;

use App\Enums\Shipment;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Coupon;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Str;

class CartService
{
    public static function getCart()
    {
        return Auth::check() ? self::getUserCart() : self::getGuestCart();
    }

    private static function getUserCart()
    {
        return Auth::user()->cart ?? self::createCart();
    }

    private static function getGuestCart()
    {
        if (!session()->has('cart_id')) {
            $cart = self::createCart();
            session(['cart_id' => $cart->id]);

            return $cart;
        }

        return Cart::whereNull('user_id')->find(session('cart_id'));
    }

    private static function createCart()
    {
        return Cart::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => Auth::check() ? Auth::user()->id : null,
        ]);
    }

    public static function addOrUpdateProduct($id, $qty, $increment)
    {
        $product = ProductVariant::with('stock')->findOrFail($id);
        if ($qty > 0 && $product->stock->stock < $qty) {
            abort(400, $product->stock->stock <= 0 ?
                'This product is out of stock.' :
                'This product has a maximum of '. $product->stock->stock . ' units.');
        }

        $cart = self::getCart();
        $line = self::checkLine($cart->id, $product->id);

        if ($line) {
            if ($increment) {
                $qty = $line->units + $qty;
            }
            $qty > 0 ? self::updateProduct($line, $qty) : $line->delete();
        } elseif ($qty > 0) {
            self::createLine($cart, $product, $qty);
        }

        return self::calcPriceCart($cart);
    }

    public static function checkLine($cartId, $productId)
    {
        return CartLine::where('cart_id', $cartId)
            ->where('product_variant_id', $productId)
            ->first();
    }

    public static function updateProduct($line, $qty)
    {
        $line->update([
            'units' => $qty,
            'total_base_price' => round($line->base_price_per_unit * $qty, 2),
            'total_price' => round($line->price_per_unit * $qty, 2),
            'total_tax' => round($line->tax_per_unit * $qty, 2),
        ]);
    }

    private static function createLine($cart, $product, $qty)
    {
        $price = $product->rate->discount_price ?? $product->rate->price;
        $basePrice = $product->rate->price;
        $tax = $price - ($price / (config('constants.iva') + 1));

        CartLine::create([
            'uuid' => Str::uuid()->toString(),
            'cart_id' => $cart->id,
            'product_variant_id' => $product->id,
            'units' => $qty,
            'base_price_per_unit' => round($basePrice, 2),
            'total_base_price' => round($basePrice * $qty, 2),
            'price_per_unit' => round($price, 2),
            'total_price' => round($price * $qty, 2),
            'tax_per_unit' => round($tax, 2),
            'total_tax' => round($tax * $qty, 2),
        ]);
    }

    public static function clearCart()
    {
        $cart = self::getCart();
        CartLine::where('cart_id', $cart->id)->delete();
        return self::removeCoupon($cart);
    }

    public static function removeCoupon($cart = null)
    {
        $cart = $cart ?? self::getCart();
        if ($cart->coupon) {
            $cart->update([
                'coupon_id' => null,
            ]);
        }

        return self::calcPriceCart($cart);
    }

    public static function addCoupon($code)
    {
        $cart = self::getCart();
        if ($cart->coupon) {
            abort(400, 'This cart has already a coupon applied.');
        }

        $coupon = Coupon::active()
            ->onValidDate()
            ->where('code', strtoupper($code))
            ->first();

        if (!$coupon) {
            abort(404);
        }

        $cart->update([
            'coupon_id' => $coupon->id,
        ]);

        return self::calcPriceCart($cart);
    }

    private static function calcPriceCart($cart)
    {
        $cart->load(['lines' => function ($q) {
            $q->orderBy('id', 'asc');
        }, 'coupon']);

        $taxes = 0;
        $subtotalPrice = 0;
        foreach ($cart->lines as $line) {
            $taxes += $line->total_tax;
            $subtotalPrice += $line->total_price;
        }

        $discount = $cart->coupon ? self::calcDiscount($cart->coupon, $subtotalPrice) : 0;
        $shipment = $subtotalPrice >= 60 ? Shipment::FREE : ($subtotalPrice >= 30 ? Shipment::REDUCED : Shipment::FULL);

        $cart->update([
            'taxes' => round($taxes, 2),
            'discount' => round($discount, 2),
            'shipment' => $shipment->value(),
            'subtotal_price' => round($subtotalPrice, 2),
            'total_price' => round(($subtotalPrice - $discount) + $shipment->value(), 2),
        ]);

        return $cart;
    }

    private static function calcDiscount($coupon, $price)
    {
        switch ($coupon->type) {
            case 'discount':
                $discount = $coupon->ammount;
                break;
            case 'percentage':
                $discount = $price * ($coupon->ammount / 100);
                break;
            default:
                $discount = 0;
        }

        return $discount > 0 ? round($discount, 2) : 0;
    }
}
