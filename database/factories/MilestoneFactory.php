<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MilestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=> $this->faker->randomElement(["milestone 1","milestone 2","milestone 3","milestone 4","milestone 5","milestone 6","milestone 7","milestone 8","milestone 9","milestone 10"]),
        ];
    }
}
