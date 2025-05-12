<?php

namespace App\Http\Controllers;

use App\Events\PaidOrder;
use App\Services\Paypal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PaypalController extends Controller
{
    public function payment(Request $request, $ammount = 10)
    {
        $paypal = new Paypal();

        $invoice = Str::random();
        $total = floatval($ammount);
        $ngrok = config('services.ngrok.url');
        $return = $ngrok . '/return';
        $cancel = $ngrok . '/cancel';
        $result = $paypal->createOrder($invoice, $total, $return, $cancel);

        $id = data_get($result, 'id');
        Cache::put('order_paypal', $id);

        $url = head(
            array_values(
                array_filter(
                    $result['links'],
                    function ($value) {
                        return ($value['rel'] == 'approve');
                    }
                )
            )
        );

        $urlRedirect = $url['href'];

        return Redirect::to($urlRedirect);
    }

    public function return(Request $request)
    {
        $token = $request->get('token');
        $payer = $request->get('PayerID');
        $paypal = new Paypal();
        $response = $paypal->confirmOrder($token);

        if ($response && $response['status'] == 'COMPLETED') {
            event(new PaidOrder($response));
        }

        return $response;
    }

    public function cancel(Request $request)
    {
        return Redirect::to('/');
    }
}
