<?php

namespace App\Http\Services;

use App\Models\Milestone;

class MilestoneService
{
    public function getMilestones()
    {
        return Milestone::all();
    }

    public function getMilestone($id)
    {
        return Milestone::find($id);
    }

    public function updateMilestrone($id, $data)
    {
        Milestone::find($id)->update($data);
    }

    public function createMilestone($data)
    {
        return Milestone::create($data);
    }

    public function deleteMilestone($id)
    {
        Milestone::find($id)->delete();
    }

    public function getMilestonesByProject($id)
    {
        return \DB::table("milestones")
            ->join("tasks", "milestone_id", "=", "milestones.id")
            ->where("milestones.project_id", $id)
            ->select(
                "milestones.name",
                "milestones.start_date",
                "milestones.end_date",
                //count all closed tasks
                \DB::raw('SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed'),
                \DB::raw('SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) as total'),
                \DB::raw('ROUND(SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / SUM(CASE WHEN status IS NOT NULL THEN 1 ELSE 0 END) * 100,2) AS total_progress'),
            )
            ->groupBy(
                "milestones.name",
                "milestones.start_date",
                "milestones.end_date"
            )   
            ->get();
    }
}
