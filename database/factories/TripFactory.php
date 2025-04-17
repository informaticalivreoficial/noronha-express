<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s').' +10 days');
        //$endDate = $this->faker->dateTimeBetween($startDate, '+10 days');

        return [
            'ship' => 'SLB Harmonia',
            'start' => $startDate,
            'stop' => $endDate,
            'information' => $this->faker->sentence(),
        ];
    }
}
