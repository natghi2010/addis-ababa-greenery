<?php

namespace App\Http\Services;

use App\Models\Report;
use App\Models\Project;
use App\Http\Services\Utilites\ReportAuthenticationService;

class ReportingService
{
    protected $ReportAuthenticationService;

    public function __construct(ReportAuthenticationService $ReportAuthenticationService)
    {
        $this->ReportAuthenticationService = $ReportAuthenticationService;
    }


    public function getReports()
    {
        return Report::all();
    }

    public function getReportDetail($id)
    {
        return Report::with('project.subcity')->find($id);
    }

    public function storeReport($data)
    {
        //$project = auth()->user()->project();

        $project = Project::first();
        $data["cheated"] = !$this->ReportAuthenticationService->isValid($project, $data['qr_code_value'], $data['location_lat'], $data['location_long']);

        return Report::create([
            "reporter_id" => auth()->user()->id,
            "location_long" => $data["location_long"],
            "location_lat" => $data["location_lat"],
            "project_id" => $project->id,
            "image" => $data["image"],
            "cheated" => $data["cheated"],
            "answer" => $data["answer"]
        ]);
    }

    public function updateReport($report, $data)
    {
        return $report->update($data);
    }
}
