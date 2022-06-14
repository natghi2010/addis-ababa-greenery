<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();

         \App\Models\ProjectType::factory(5)->create()->each(function ($projectType) {
            $projectType->projects()->saveMany(Project::factory(5)->make());
         });
    }
}
