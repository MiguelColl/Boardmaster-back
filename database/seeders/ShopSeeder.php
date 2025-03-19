<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $shop = Shop::create([
                'name' => $this->getShopName(),
            ]);

            Address::factory()->create([
                'user_id' => null,
                'shop_id' => $shop->id,
            ]);
        }
    }

    private function getShopName()
    {
        do {
            $name = fake()->moon() . ' Games';
        } while (Shop::where('name', $name)->exists());

        return $name;
    }
}
