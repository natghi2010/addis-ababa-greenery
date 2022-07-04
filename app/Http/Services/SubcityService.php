<?php

namespace App\Http\Services;

class SubcityService
{
    public function getProjectsBySubcity($subcity_id = false, $project_type_id = false, $project_id = false)
    {
        return \DB::table("projects")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("project_types", "projects.project_type_id", "=", "project_types.id")
            ->join("subcities", "projects.subcity_id", "=", "subcities.id")
            ->when($subcity_id, function ($query) use ($subcity_id) {
                return $query->where("subcities.id", $subcity_id);
            })
            ->when($project_id, function ($query) use ($project_id) {
                return $query->where("projects.id", $project_id);
            })
            ->when($project_type_id, function ($query) use ($project_type_id) {
                return $query->where("project_types.id", $project_type_id);
            })
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                "subcities.id as subcity_id",
                "subcities.name as subcity_name",
                "projects.name as project_name",
                "projects.id as project_id",
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                "project_types.title as project_type_name",
                "project_types.id as project_type_id"
            )
            ->groupBy(
                "project_types.title",
                "project_types.id",
                "projects.id",
                "projects.name",
                "subcities.id",
                "subcities.name"
            )
            ->get();
    }

    public function getProjectTypesBySubcity($subcity_id)
    {
        return \DB::table("project_types")
            ->join("projects", "projects.project_type_id", "=", "project_types.id")
            ->join("tasks", "projects.id", "=", "tasks.project_id")
            ->join("subcities", "projects.subcity_id", "=", "subcities.id")
            ->where('subcities.id', $subcity_id)
            ->select(
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                "subcities.id as subcity_id",
                "subcities.name as subcity_name",
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
                "project_types.title as project_type_name",
                "project_types.id as project_type_id"
            )
            ->groupBy(
                "project_types.title",
                "project_types.id",
                "subcities.id",
                "subcities.name"
            )
            ->get();
    }
}
