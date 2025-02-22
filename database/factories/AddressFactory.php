<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $street = explode(' ', fake()->streetAddress());
        $zipCode = $street[0];
        unset($street[0]);

        return [
            'main_address' => true,
            'address' => join(' ', $street),
            'zipcode' => $zipCode,
            'province' => fake()->city(),
            'country' => fake()->country(),
        ];
    }
}
