<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        fake()->addProvider(new \Bezhanov\Faker\Provider\Space(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Xvladqt\Faker\LoremFlickrProvider(fake()));

        DB::table('categories')->delete();
        DB::table('menus')->delete();
        DB::table('shops')->delete();
        DB::table('orders')->delete();
        DB::table('addresses')->delete();
        DB::table('comments')->delete();
        DB::table('users')->delete();
        DB::table('users_cms')->delete();
        DB::table('stocks')->delete();
        DB::table('rates')->delete();
        DB::table('product_variants')->delete();
        DB::table('product_models')->delete();
        DB::table('coupons')->delete();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ShopSeeder::class,
            MenuSeeder::class,
            OrderSeeder::class,
            CouponSeeder::class,
        ]);
    }
}
