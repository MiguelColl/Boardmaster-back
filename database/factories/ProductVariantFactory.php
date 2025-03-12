<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [];
        $numberImages = rand(2, 4);
        for ($i = 0; $i < $numberImages; $i++) {
            $images[] = fake()->imageUrl(640, 480, ['cats'], true);
        }

        return [
            'sku' => '',
            'color' => '',
            'images' => $images,
        ];
    }
}
