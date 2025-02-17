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
    protected $reportSummaryService;

    public function __construct(
        ReportSummaryService $reportSummaryService,
        TaskService $taskService,
        MilestoneService $milestoneService
    ) {
        $this->reportSummaryService = $reportSummaryService;
        $this->taskService = $taskService;
        $this->milestoneService = $milestoneService;
    }


    public function getProjects()
    {
        return Project::all();
    }


    public function getProjectBasicInfo($id)
    {
        return Project::with("projectType", "subcity", "stakeHolders.user", "teamMembers.user", "teamLeader")->find($id);
    }

    public function getProjectsByProjectType($project_type_id)
    {

        $projectType = $this->reportSummaryService->getProjectTypeSummary($project_type_id)->first();
        $projectType->projects =  $this->reportSummaryService->getProjectsSummary($project_type_id);
        return $projectType;
    }

    public function getProject($id)
    {
        $project =  Project::with("projectType", "subcity", "challenges", "teamLeader", "teamMembers.user", "reports", "stakeHolders.user")->find($id);
        $project->milestones =  $this->reportSummaryService->getProjectMilestone($project->project_type_id, $project->id);
        $project->milestones->each(function ($milestone) {
            $milestone->tasks = $this->reportSummaryService->getTaskByMileStone($milestone->milestone_id);
        });

        return $project;
    }


    public function getProjectTasks($id)
    {
        return $this->taskService->getTaskSummaryByProject($id);
    }

    public function createProject($data)
    {

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

                $project->teamMembers()->createMany($data["team_members"]);
                $project->stakeholders()->createMany($data["stake_holders"]);

                foreach ($data["milestones"] as $milestone) {
                    $milestones[] = [
                        "name" => $milestone["name"],
                        "description" => $milestone["description"]
                    ];
                }

                $count = 0;

                $project->milestones()->createMany($milestones)->each(
                    function ($milestone) use ($count, $data, $project) {
                        foreach ($data["milestones"][$count]["tasks"] as $key => $task) {
                            $data["milestones"][$count]["tasks"][$key]["project_id"] = $project->id;
                        }
                        $milestone->tasks()->createMany($data["milestones"][$count]["tasks"]);
                        $count++;
                    }
                );
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


    public function getProjectFormOptions()
    {

        $data = [
            "project_types" => \DB::table("project_types")->select('id', 'title')->get(),
            "users" => \DB::table("users")->select('id', 'name')->get(),
            "subcities" => \DB::table("subcities")->select('id', 'name')->get()
        ];

        return $data;
    }

    public function getProjectMilestones(int $id)
    {
        return $this->milestoneService->getMilestonesByProject($id);
    }

    public function getCheatedReports(int $id)
    {
        return \DB::table("reports")
            ->join("users", "users.id", "=", "reports.reporter_id")
            //join milestones with reports created_at date between  milestone start date and end date
            ->join("milestones", function ($join) {
                $join->on("milestones.project_id", "=", "reports.project_id")
                    ->whereBetween("reports.created_at", ["milestones.start_date", "milestones.end_date"]);
            })
            ->where("reports.project_id", $id)
            ->where("cheated", 1)
            ->select(
                "users.name as reporter_name",
                //convert created_at date
                \DB::raw("DATE_FORMAT(reports.created_at, '%d/%m/%Y') as date"),
            )
            ->get();
    }
}
