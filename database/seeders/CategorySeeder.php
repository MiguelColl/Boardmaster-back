<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Category::factory()->create();
        }

        $categoriesBase = Category::all();
        foreach ($categoriesBase as $categoryBase) {
            $this->generateRandomChilds($categoryBase);
        }
    }

    public function generateRandomChilds($categoryBase, $subLevel = true)
    {
        $rand = rand(0, 3);
        for ($i = 0; $i < $rand; $i++) {
            $category = Category::factory()->create();
            $category->path = "$categoryBase->path.$category->path";
            $category->save();

            if ($subLevel) {
                $this->generateRandomChilds($category, false);
            }
        }
    }
}
