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
            "title"=>$this->faker->randomElement(["project type 1","project type 2","project type 3","project type 4","project type 5","project type 6","project type 7","project type 8","project type 9","project type 10"]),
        ];
    }
}
