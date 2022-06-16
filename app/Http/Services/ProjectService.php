<?php

namespace App\Http\Services;

use App\Models\Task;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\TeamMember;
use App\Models\StakeHolder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectService
{
    public function getProjects()
    {
        return Project::all();
    }

    public function getProjectsByProjectType($project_type_id)
    {
        return Project::where('project_type_id', $project_type_id)->get();
    }

    public function getProject($id)
    {
        return Project::with("projectType", "challenges", "milestones.tasks", "teamLeader", "teamMembers.user", "stakeHolders.user")->find($id);
    }

    public function createProject($data)
    {
return $data;
        \DB::beginTransaction();

           Project::create([
            "name" => $data["name"],
            "project_type_id" => $data["project_type_id"],
            "team_leader_id" => $data["team_leader_id"],
            "subcity_id" => $data["subcity_id"],
            // "qr_code_id" => $data["qr_code_id"],
            "location_lat" => $data["location_lat"],
            "location_long" => $data["location_long"],
            "description" => $data["description"],
            "start_date" => Carbon::now()->toDateTimeString(),
            "end_date" => Carbon::now()->addMonth(3)->toDateTimeString(),
        ])->each(
            function ($project) use ($data) {

                $project->milestones()->createMany($data["milestones"])->each(

                );

                $project->milestones()->createMany($data["milestones"],["project_id" => $project->id]);
              //  $project->teamMembers()->createMany($data["team_members"]);
             //   $project->stakeHolders()->createMany($data["stake_holders"]);
            }
        );


        \DB::commit();
    }

    public function updateProject($id, $data)
    {
        Project::find($id)->update($data);
    }

    public function deleteProject($id)
    {
        Project::find($id)->delete();
    }
}
