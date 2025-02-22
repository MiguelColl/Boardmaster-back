<?php

namespace Database\Factories;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $code = sprintf('%04d', rand(0, 9999)) . '-' . sprintf('%04d', rand(0, 9999));
        } while (ProductModel::where('code', $code)->exists());

        $name = fake()->productName();

        return [
            'code' => $code,
            'name' => $name,
            'brand' => ucfirst(fake()->word()),
            'image' => fake()->imageUrl(640, 480, ['cats'], true),
            'title' => $name,
            'description' => fake()->sentence(),
            'url' => fake()->url(),
        ];
    }
}
