<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function deleteUser()
    {
        $user = \App\Models\User::firstOrFail();
        $user->delete();

        return response()->json(
            [
                'error' => false,
                'message' => "User [$user->id] $user->name deleted",
            ],
            200
        );
    }

    public function changeStatus($status)
    {
        $order = \App\Models\Order::firstOrFail();

        if (is_numeric($status)) {
            $order->status = (int) $status;
        } else {
            $order->delivery_name = $status;
        }

        $order->update();

        return response()->json(
            [
                'error' => false,
                'order' => $order,
            ],
            200
        );
    }

    public function cache()
    {
        return response()->json([
            'products' => Cache::has('products'),
            'new_products' => Cache::has('new_products'),
            'product_81' => Cache::has('product_81'),
            'product_comments_81' => Cache::has('product_comments_81'),
            'product_url_http://bergstrom.com/' => Cache::has('product_url_http://bergstrom.com/'),
            'menu' => Cache::has('menu'),
            'menu_13' => Cache::has('menu_13'),
        ], 200);
    }
}
