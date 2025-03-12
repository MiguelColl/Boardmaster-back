<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([
            'user_id' => \App\Models\User::latest('id')->first()->id,
            'unique_id' => '094e1deb-4e74-4d5c-bf6d-529e84ed5eb2',
            'email' => 'test@test.com',
            'delivery_name' => 'Miguel',
            'delivery_surname' => 'Collado',
            'delivery_address' => 'asd',
            'delivery_zipcode' => '123',
            'delivery_province' => 'asd',
            'delivery_country' => 'asd',
            'delivery_phone' => '123',
            'payment_method' => 'asd',
            'paid' => true,
            'total_price' => 1.00,
            'tax_price' => 1.00,
            'subtotal_price' => 1.00,
            'shipping_price' => 1.00,
            'shipping_tax' => 1.00,
            'status' => 1,
        ]);
    }
}
