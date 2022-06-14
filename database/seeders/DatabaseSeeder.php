<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\ProjectType;
use App\Models\StakeHolder;
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


        \App\Models\ProjectType::factory(5)->create()->each(function ($projectType) {

            $projectType->projects()->saveMany(Project::factory(5)->create(["project_type_id" => $projectType->id])->each(function ($project) {

                $project->milestones()->saveMany(Milestone::factory(5)->create(["project_id" => $project->id])->each(function ($milestone) use ($project) {
                    $milestone->tasks()->saveMany(Task::factory(5)->create(["project_id" => $project->id, "milestone_id" => $milestone->id]));
                }));

                $project->stakeHolders()->saveMany(User::factory(1)->create());
                $project->teamMembers()->saveMany(User::factory(1)->create());

            }));
        });
    }
}
