<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            // Commerce faker can only generate 22 different categories
            $code = Category::count('id') < 22 ? strtolower(fake()->category()) : strtolower(fake()->category() . '-' . fake()->category());
        } while (Category::where('code', $code)->exists());

        return [
            'code' => $code,
            'name' => fake()->department(),
            'description' => fake()->sentence(),
            'node_type' => 'category',
            'url' => fake()->url(),
            'path' => $code,
        ];
    }
}
