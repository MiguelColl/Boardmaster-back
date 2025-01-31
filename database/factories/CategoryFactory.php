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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        do {
            $code = strtolower($faker->category);
        } while (Category::where('code', $code)->exists());

        return [
            'code' => $code,
            'name' => $faker->department,
            'description' => fake()->sentence(),
            'node_type' => 'category',
            'url' => fake()->url(),
            'path' => $code,
        ];
    }
}
