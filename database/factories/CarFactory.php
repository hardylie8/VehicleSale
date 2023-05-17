<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'engine' => $this->faker->word(1),
            'capacity' => $this->faker->numberBetween(2, 10),
            'type' => $this->faker->word(1),
        ];
    }
}
