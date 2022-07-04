<?php

namespace App\Http\Services;

class ReportSummaryService
{

    public function getOverAllProgress()
    {
        return \DB::table("tasks")
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
            )
            ->get();
    }

    public function getProjectTypeSummary($project_type_id = false)
    {
        return \DB::table("projects")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
            ->when($project_type_id, function ($query) use ($project_type_id) {
                return $query->where("project_types.id", $project_type_id);
            })
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                "project_types.title as project_type_name",
                "project_types.id as project_type_id"
            )
            ->groupBy(
                "project_types.title",
                "project_types.id"
            )
            ->get();
    }


    public function getProjectsSummary($project_type_id)
    {
        return \DB::table("projects")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
            ->where("project_types.id", $project_type_id)
            ->when($project_type_id, function ($query) use ($project_type_id) {
                return $query->where("project_types.id", $project_type_id);
            })
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                \DB::raw('DATEDIFF(projects.end_date,projects.start_date) as duration'),
                "projects.name as project_name",
                "projects.id as project_id"
            )
            ->groupBy(
                "projects.name",
                "projects.id",
                "projects.start_date",
                "projects.end_date"
            )->get();
    }

    public function getProjectMilestone($project_id)
    {
        return \DB::table("projects")
            ->join("milestones", "milestones.project_id", "=", "projects.id")
            ->join("tasks", "milestones.id", "=", "tasks.milestone_id")
            ->where("projects.id", $project_id)
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                "milestones.name as milestone_name",
                "milestones.id as milestone_id",
                //get the difference between start and end date of the milestone in days
                \DB::raw('DATEDIFF(milestones.end_date,milestones.start_date) as duration'),
                //get the remaining days of the milestone
                \DB::raw('DATEDIFF(milestones.end_date,CURDATE()) as remaining_days'),

            )
            ->groupBy(
                "milestones.id",
                "milestones.name",
                "milestones.start_date",
                "milestones.end_date",
                "milestones.deadline"
            )
            ->orderBy(
                "milestones.name"
            )
            ->get();
    }


    public function getProjectSummaryBySubcity($subcity = false)
    {
        return \DB::table("projects")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
            ->join("subcities", "projects.subcity_id", "=", "subcities.id")
            //if subcity is not false, then filter the results by subcity
            ->when($subcity, function ($query) use ($subcity) {
                return $query->where("subcities.id", $subcity);
            })
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                "subcities.name as subcity_name",
                "subcities.id as subcity_id"
            )
            ->groupBy(
                "subcities.id",
                "subcities.name",
            )->get();
    }

    public function getTaskByMileStone($milestone_id)
    {
        return \DB::table("tasks")
            ->where('milestone_id', $milestone_id)
            ->select(
                "id",
                "title",
                "status"
            )
            ->orderBy(
                "status"
            )
            ->get();
    }
}
