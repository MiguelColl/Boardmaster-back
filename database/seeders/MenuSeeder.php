<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->delete();

        for ($i = 0; $i < 5; $i++) {
            Menu::factory()->create();
        }

        $menusBase = Menu::all();
        foreach ($menusBase as $menuBase) {
            $this->generateRandomChilds($menuBase);
        }
    }

    public function generateRandomChilds($menuBase)
    {
        $rand = rand(1, 3);
        for ($i = 0; $i < $rand; $i++) {
            $menu = Menu::factory()->create();
            $menu->path = "$menuBase->path.$menu->path";
            $menu->save();
        }
    }
}
