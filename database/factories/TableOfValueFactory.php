<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TableOfValue>
 */
class TableOfValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
