<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class Paypal
{
    private $paypalUrl = 'https://sandbox.paypal.com/';

    private function getToken()
    {
        $token = 'v1/oauth2/token';
        $response = Http::withBasicAuth(
            config('services.paypal.clientID'),
            config('services.paypal.secret')
        )->asForm()
            ->post(
                $this->paypalUrl . $token,
                [
                    'grant_type' => 'client_credentials'
                ]
            );

        if ($response->ok()) {
            $authToken = $response->json('access_token');
            $time = $response->json(('expires_in'));
            $time -= 90;

            Cache::put('paypal_token', $authToken, $time);

            return $authToken;
        }

        return $response->json();
    }

    public function createOrder($invoice, $total, $return, $cancel)
    {
        $order = 'v2/checkout/orders';
        $token = Cache::get('paypal_token', $this->getToken());

        $json = [
            'intent' => 'CAPTURE',
            'invoice_id' => $invoice,
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => $total,
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'EUR',
                                'value' => $total
                            ]
                        ]
                    ]
                ]
            ],
            'application_context' => [
                'locale' => 'es-ES',
                'return_url' => $return,
                'cancel_url' => $cancel
            ]
        ];

        $response = Http::withToken($token)
            ->post(
                $this->paypalUrl . $order,
                $json
            );

        return $response->json();
    }

    public function confirmOrder($id)
    {
        $order = 'v2/checkout/orders/' . $id . '/capture';
        $token = Cache::get('paypal_token', $this->getToken());

        $response = Http::withToken($token)
            ->withHeaders(
                [
                    'PayPal-Request-Id' => Uuid::uuid4()->toString(),
                    'Content-Type' => 'application/json'
                ]
            )
            ->post(
                $this->paypalUrl . $order,
                null
            );

        $response->onError(function ($res) {
            print_r($res->getBody()->getContents());
        });

        return $response->json();
    }
}
