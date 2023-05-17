<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'year' => $this->faker->numberBetween(1900, 2023),
            'price' => $this->faker->numberBetween(1000000, 1000000000),
            'color' => $this->faker->colorName(), // password
            'stock' => $this->faker->randomNumber(),
            'car_id' => 1,
            'motorcycle_id' => 1,

        ];
    }
}
