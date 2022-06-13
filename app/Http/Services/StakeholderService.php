<?php

namespace App\Http\Services;

use App\Models\StakeHolder;

class StakeholderService
{
    public function getStakeholders()
    {
        return Stakeholder::all();
    }

    public function getStakeholder($id)
    {
        return Stakeholder::find($id);
    }

    public function createStakeholder($data)
    {
        return Stakeholder::create($data);
    }

    public function updateStakeholder($id, $data)
    {
        Stakeholder::find($id)->update($data);
    }

    public function deleteStakeholder($id)
    {
        Stakeholder::find($id)->delete();
    }
}
