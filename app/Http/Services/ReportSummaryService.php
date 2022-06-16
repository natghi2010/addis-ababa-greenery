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

    public function getProjectTypeSummary()
    {
        return \DB::table("projects")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
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
            ->where("project_types", $project_type_id)
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
                "milestones.id as milestone_id"
            )
            ->groupBy(
                "milestones.id",
                "milestones.name",
            )->get();
    }

}
