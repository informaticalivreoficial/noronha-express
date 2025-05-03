<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manifest>
 */
class ManifestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trip' => Trip::factory(),
            'type' => $this->faker->randomElement(['fisica', 'juridica']),
            'object' => $this->faker->randomElement(['carga', 'reposição']),
            'user' => User::factory(),
            'status' => $this->faker->boolean(),
            'zipcode' => fake()->postcode,
            'street' => fake()->streetName,
            'number' => fake()->buildingNumber,
            'complement' => fake()->secondaryAddress,
            'neighborhood' => fake()->streetName,
            'state' => fake()->stateAbbr,
            'city' => fake()->city,
            'information' => fake()->text(200),
            'contact' => fake()->text(30),
        ];
    }
}
