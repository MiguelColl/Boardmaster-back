<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\ProductModel;
use App\Models\ProductVariant;
use App\Models\Rate;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 80; $i++) {
            $model = ProductModel::factory()->create();

            $this->generateComments($model);
            $this->generateVariants($model);

            $categories = Category::where('node_type', 'category')->orderBy('id')->get();
            $catNumber = rand(5, count($categories) - 1);

            Category::create([
                'code' => $model->code,
                'name' => $model->name,
                'description' => $model->description,
                'node_type' => 'model',
                'url' => $model->url,
                'path' => $categories[$catNumber]->path . '.' . $model->code,
            ]);
        }
    }

    private function generateVariants($model)
    {
        $unique = rand(0, 10) != 10; // 10% chance of generating variants
        $numberVariants = rand(2, 3);
        $colors = ['blue', 'yellow', 'red', 'green', 'purple'];

        shuffle($colors);

        $variantColors = $unique ? ['null'] : array_slice($colors, 0, $numberVariants);

        foreach ($variantColors as $color) {
            $variant = ProductVariant::factory()->create([
                'product_model_id' => $model->id,
                'sku' => $this->generateSku($model),
                'color' => $color == 'null' ? null : $color,
            ]);

            $this->generateStock($variant);
            $this->generateRate($variant);
        }
    }

    private function generateSku($model)
    {
        $nameNoSpaces = str_replace(' ', '', $model->name);
        $name = strlen($nameNoSpaces) <= 5 ? $nameNoSpaces : substr($nameNoSpaces, 0, 5);

        $brandNoSpaces = str_replace(' ', '', $model->brand);
        $brand = strlen($brandNoSpaces) <= 3 ? $brandNoSpaces : substr($brandNoSpaces, 0, 3);

        do {
            $number = rand(1, 999);
            $sku = strtoupper($name) . '-' . strtoupper($brand) . '-' . $number;
        } while (ProductVariant::where('sku', $sku)->exists());

        return $sku;
    }

    private function generateStock($variant)
    {
        Stock::create([
            'product_variant_id' => $variant->id,
            'stock' => rand(0, 15),
            'sku' => $variant->sku,
            'last_stock_update' => Carbon::now(),
        ]);
    }

    private function generateRate($variant)
    {
        $price = round(rand(15, 79) + (mt_rand() / mt_getrandmax()), 2);
        $discount = rand(0, 2) == 2 ? rand(5, 15) * 0.01 : 0; // 33% chance to get a discount between 5-15%
        $discountPrice = round($price - ($price * $discount), 2);

        Rate::create([
            'product_variant_id' => $variant->id,
            'price' => $price,
            'discount_price' => $discount ? $discountPrice : null,
            'price_suggested' => $price,
            'sku' => $variant->sku,
        ]);
    }

    private function generateComments($model)
    {
        $ammount = rand(3, 6);
        Comment::factory($ammount)->create([
            'product_model_id' => $model->id,
        ]);
    }
}
