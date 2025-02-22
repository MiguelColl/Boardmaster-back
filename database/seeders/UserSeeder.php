<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->delete();
        DB::table('users')->delete();

        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->create();

            Address::factory()->create([
                'user_id' => $user->id,
                'shop_id' => null,
            ]);
        }
    }
}
