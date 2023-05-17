<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MotorcycleFactory extends Factory
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
            'suspension_type' => $this->faker->word(1),
            'transmission_type' => $this->faker->word(1),
        ];
    }
}
