<?php

namespace App\Http\Services;

use App\Models\TeamMember;

class TeamMemberService
{
    public function getTeamMembers()
    {
        return TeamMember::all();
    }

    public function getTeamMember($id)
    {
        return TeamMember::find($id);
    }

    public function createTeamMember($data)
    {
        return TeamMember::create($data);
    }

    public function updateTeamMember($id, $data)
    {
       return TeamMember::find($id)->update($data);
    }

    public function deleteTeamMember($id)
    {
       return TeamMember::find($id)->delete();
    }

}
