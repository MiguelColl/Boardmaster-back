<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Mail\OrderSended;
use App\Mail\UnsubscribedUser;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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
        $order = Order::firstOrFail();

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
            'products' => Cache::has('products_1'),
            'new_products' => Cache::has('new_products_1'),
            'product_81' => Cache::has('product_81'),
            'product_comments_81' => Cache::has('product_comments_81'),
            'product_url_http://bergstrom.com/' => Cache::has('product_url_http://bergstrom.com/'),
            'menu' => Cache::has('menu'),
            'menu_13' => Cache::has('menu_13'),
            'search_eos' => Cache::has('search_eos_1'),
        ], 200);
    }

    public function changeModel($action)
    {
        switch ($action) {
            case 'insert':
                $model = \App\Models\ProductModel::create([
                    'id' => 9999,
                    'code' => '9999-9999',
                    'name' => 'Product Test',
                    'description' => 'Test Description'
                ]);
                break;
            case 'update':
                $model = \App\Models\ProductModel::findOrFail(9999);
                $model->brand = fake()->word();
                $model->update();
                break;
            case 'delete':
                $model = \App\Models\ProductModel::findOrFail(9999);
                $model->delete();
                break;
        }

        return response()->json(
            [
                'error' => false,
                'action' => $action,
                'model' => $model,
            ],
            200
        );
    }

    public function testEmail(Request $request, $action)
    {
        $send = filter_var($request->input('send', false), FILTER_VALIDATE_BOOLEAN);
        $order = Order::with('lines')->findOrFail(3);

        switch ($action) {
            case 'orderCreated':
                $email = new OrderCreated($order);
                break;
            case 'orderSended':
                $email = new OrderSended($order);
                break;
            case 'unsubscribedUser':
                $email = new UnsubscribedUser(User::first());
        }

        if ($send) {
            Mail::send($email);
        }

        return $email;
    }
}
