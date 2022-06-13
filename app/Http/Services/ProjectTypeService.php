<?php

namespace App\Http\Services;

use App\Models\ProjectType;

class ProjectTypeService
{
    public function getProjectTypes()
    {
        return ProjectType::all();
    }

    public function getProjectType($id)
    {
        return ProjectType::find($id);
    }

    public function createProjectType($request)
    {
        return ProjectType::create($request);
    }

    public function deleteProjectType($id)
    {
        return ProjectType::find($id)->delete();
    }
}
