<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Services\ProjectService;
use App\Http\Services\SubcityService;

class ProjectController extends Controller
{
    protected $projectService;
    protected $subcityService;

    public function __construct(SubcityService $subcityService, ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->subcityService = $subcityService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProjectsByProjectType($project_type_id)
    {
        try {

            $projects = $this->projectService->getProjectsByProjectType($project_type_id);

            return response()->success($projects);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $projects = $this->projectService->getProjects();

            return response()->success($projects);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectCreateRequest $request)
    {
        try {

            $this->projectService->createProject($request->all());

            return response()->success();
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $project = $this->projectService->getProject($id);

            return response()->success($project);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getProjectFormOptions()
    {
        try {
            $project_types = $this->projectService->getProjectFormOptions();

            return response()->success($project_types);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }

    public function getProjectTypesBySubcity($subcity_id)
    {
        try {
            $project_types = $this->subcityService->getProjectTypesBySubcity($subcity_id);

            return response()->success($project_types);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }

    public function getProjectsBySubcity($subcity_id, $project_type_id)
    {
        try {
            $projects = $this->subcityService->getProjectsBySubcity($subcity_id, $project_type_id);

            return response()->success($projects);
        } catch (\Throwable $th) {

            return response()->error($th->getMessage());
        }
    }
}
