<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'user' => User::factory(),
            'zipcode' => fake()->postcode,
            'street' => fake()->streetName,
            'number' => fake()->buildingNumber,
            'complement' => fake()->secondaryAddress,
            'neighborhood' => fake()->streetName,
            'state' => fake()->stateAbbr,
            'city' => fake()->city,
            'select' => $this->faker->boolean()
        ];
    }
}
