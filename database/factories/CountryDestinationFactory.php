<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CountryDestination>
 */
class CountryDestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => fake()->city(),
            'country_id'    => Country::inRandomOrder()->first()->id,
            'lat'   => fake()->latitude(),
            'lng'   => fake()->longitude(),
        ];
    }
}
