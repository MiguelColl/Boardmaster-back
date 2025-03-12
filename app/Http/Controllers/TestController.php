<?php

namespace App\Http\Controllers;

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
}
