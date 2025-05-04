<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'init_at' => Carbon::now()->startOfDay(),
            'finish_at' => Carbon::now()->addDays(7)->endOfDay(),
            'code' => 'DISC5',
            'type' => 'discount',
            'ammount' => 5,
        ]);

        Coupon::create([
            'init_at' => Carbon::now()->startOfDay(),
            'code' => 'WELCOME',
            'type' => 'percentage',
            'ammount' => 10,
        ]);
    }
}
