<?php

namespace App\Http\Services;

use App\Models\Project;

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
        return Project::find($id);
    }

    public function createProject($data)
    {
        return Project::create($data);
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
