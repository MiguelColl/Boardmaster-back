<?php

namespace App\Services;

class Checkout
{
    public static function checkStock($cart)
    {
        $productsWithoutStock = [];

        foreach ($cart->lines as $line) {
            if ($line->variant->stock->stock < $line->units) {
                $productsWithoutStock[$line->variant->id] = $line->variant->stock->stock;
            }
        }

        return (object) [
            'error' => !empty($productsWithoutStock),
            'message' => 'There are products in yout cart out of stock.',
            'products' => $productsWithoutStock,
        ];
    }

    public static function validateFields()
    {

    }
}
