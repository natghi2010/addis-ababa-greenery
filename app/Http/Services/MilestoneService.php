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
}
