<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->randomElement(['task 1', 'task 2', 'task 3', 'task 4', 'task 5', 'task 6', 'task 7', 'task 8', 'task 9', 'task 10']),
            "description" => $this->faker->text,
            "status" => $this->faker->randomElement(["pending", "in progress", "closed"]),
        ];
    }
}
