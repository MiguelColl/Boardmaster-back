<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ShopSeeder::class,
        ]);
    }
}
