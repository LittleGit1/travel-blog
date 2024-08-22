<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin_name'       => fake()->country(),
            'destination_name'  => fake()->country(),
            'origin_lat'        => fake()->latitude(),
            'origin_lng'        => fake()->longitude(),
            'destination_lat'   => fake()->latitude(),
            'destination_lng'   => fake()->longitude()
        ];
    }
}
