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

        //convert base 64 to file
        $image = $data['image'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'report_' . time() . '.png';
        $imagePath = public_path() . '/images/' . $imageName;
        \File::put($imagePath, base64_decode($image));

        $data['image'] = $imageName;

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
