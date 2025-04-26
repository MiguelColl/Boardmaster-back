<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Login
{
    public static function getInfo()
    {
        $user = Auth::user();
        if ($user && !session()->has('total_user_orders')) {
            self::getTotalOrders($user);
        }

        return [
            'user' => $user,
            'total_orders' => session('total_user_orders'),
        ];
    }

    private static function getTotalOrders($user)
    {
        $orders = Order::where('user_id', $user->id)->get();

        session(['total_user_orders' => count($orders)]);
    }
}
