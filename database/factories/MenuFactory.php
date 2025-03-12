<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
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
            $code = Menu::count('id') < 22 ? strtolower(fake()->category()) : strtolower(fake()->category() . '-' . fake()->category());
        } while (Menu::where('code', $code)->exists());

        return [
            'code' => $code,
            'name' => fake()->department(),
            'url' => fake()->url(),
            'node_type' => 'menu',
            'path' => $code,
        ];
    }
}
