<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            "name"=>$this->faker->word,
            "description"=>$this->faker->text,
            "cover_image"=>"https://www.arabianbusiness.com/cloud/2021/09/14/ZGzm4bk2-la-gare-eagle-hills.jpg",
            "location_lat"=>$this->faker->latitude,
            "location_long"=>$this->faker->longitude,
            "start_date"=>today(),
            "end_date"=>today()->addDays(50),
        ];
    }
}
