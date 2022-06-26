<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use App\Models\Project;
use App\Models\Subcity;
use App\Models\Milestone;
use App\Models\ProjectType;
use App\Models\StakeHolder;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Subcity::factory(1)->create(["name" => "yeka", "abbrevation" => "yeka"]);
        Subcity::factory(1)->create(["name" => "kirkos", "abbrevation" => "kirkos"]);
        Subcity::factory(1)->create(["name" => "arada", "abbrevation" => "arada"]);
        Subcity::factory(1)->create(["name" => "yeka", "abbrevation" => "yeka"]);
        Subcity::factory(1)->create(["name" => "nefas-Silk Laphto", "abbrevation" => "N/silk"]);
        Subcity::factory(1)->create(["name" => "gullele", "abbrevation" => "gullele"]);
        Subcity::factory(1)->create(["name" => "kolfe-Keranio", "abbrevation" => "kolfe"]);
        Subcity::factory(1)->create(["name" => "lideta", "abbrevation" => "lideta"]);
        Subcity::factory(1)->create(["name" => "addis Ketema", "abbrevation" => "A/Ketema"]);
        Subcity::factory(1)->create(["name" => "akaki-Kality", "abbrevation" => "A/Kality"]);
        Subcity::factory(1)->create(["name" => "lemi Kura", "abbrevation" => "lemi"]);


        User::factory(1)->create(["email" => "admin@green.com"]);

        \App\Models\ProjectType::factory(5)->create()->each(function ($projectType) {

            User::factory(1)->create()->each(function ($user) use ($projectType) {

                $projectType->projects()->saveMany(Project::factory(5)->create(["project_type_id" => $projectType->id,
                "team_leader_id" => $user->id, "subcity_id" => Subcity::inRandomOrder()->first()->id])->each(function ($project) {

                    $project->teamMembers()->create(["user_id" => 1]);


                    $project->reports()->saveMany(Report::factory(5)->create([
                        "project_id" => $project->id,
                        "reporter_id" => 1,
                        "image" => "https://freerangestock.com/sample/20377/building-under-construction.jpg",
                        "location_lat" => 12.0000,
                        "location_long" => 12.000,
                        "cheated" => false
                    ]));


                    $project->milestones()->saveMany(Milestone::factory(5)->create(["project_id" => $project->id])->each(function ($milestone) use ($project) {

                        $milestone->tasks()->saveMany(Task::factory(5)->create(["project_id" => $project->id, "milestone_id" => $milestone->id]));

                        User::factory(1)->create()->each(function ($user) use ($project) {
                            $project->stakeHolders()->create(["user_id" => $user->id, "project_id" => $project->id]);
                        });

                        User::factory(1)->create()->each(function ($user) use ($project) {
                            $project->teamMembers()->create(["user_id" => $user->id, "project_id" => $project->id]);
                        });

                    }));

                }));
            });
        });
    }
}
