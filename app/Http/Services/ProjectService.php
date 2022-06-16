<?php

namespace App\Http\Services;

use App\Models\Task;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\TeamMember;
use App\Models\StakeHolder;
use Illuminate\Support\Facades\DB;

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
        \DB::beginTransaction();

           Project::create([
            "name" => $data["name"],
            "project_type_id" => $data["project_type_id"],
            "team_leader_id" => $data["team_leader_id"],
            "subcity_id" => $data["subcity_id"],
            "qr_code_id" => $data["qr_code_id"],
            "location_lat" => $data["location_lat"],
            "location_long" => $data["location_long"],
            "description" => $data["description"],
            "start_date" => $data["start_date"],
            "end_date" => $data["end_date"],
        ])->each(
            function ($project) use ($data) {
                $project->milestones()->saveMany($data["milestones"])->each(
                    function ($milestone) use ($data) {
                        $milestone->tasks()->saveMany($data["milestones"]["title"]["tasks"]);
                    }
                );
                $project->stakeHolders()->saveMany($data["stake_holders"]);
                $project->teamMembers()->saveMany($data["team_members"]);
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
