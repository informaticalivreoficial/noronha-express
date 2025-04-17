<?php

namespace Database\Factories;

use App\Models\Manifest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManifestItem>
 */
class ManifestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manifest' => Manifest::factory(),
            'unit' => $this->faker->randomElement(['vl', 'fd', 'cx']),
            'description' => $this->faker->text(50),
            'quantity' => $this->faker->numberBetween(1, 100),
            'horti-fruit' => $this->faker->randomFloat(2, 0, 100),
            'cubage' => $this->faker->randomFloat(2, 0, 100),
            'secure' => $this->faker->randomFloat(2, 0, 100),
            'dry_weight' => $this->faker->randomFloat(2, 0, 100),
            'package' => $this->faker->randomFloat(2, 0, 100),
            'glace' => $this->faker->randomFloat(2, 0, 100),
            'tax' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
