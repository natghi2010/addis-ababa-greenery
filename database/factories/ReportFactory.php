<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "answer"=>$this->faker->randomElement(["Need more supplies.","There is a slow progress.","The rain is becoming an obstacle.","The paint must be repainted.",null])
        ];
    }
}
