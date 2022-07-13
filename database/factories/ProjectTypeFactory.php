<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->randomElement(["Project Category 1", "Project Category 2", "Project Category 3", "Project Category 4", "Project Category 5", "Project Category 6", "Project Category 7", "Project Category 8", "Project Category 9", "Project Category 10"]),
        ];
    }
}
