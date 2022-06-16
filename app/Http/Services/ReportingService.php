<?php

namespace App\Http\Services;

use App\Http\Services\Utilites\ReportAuthenticationService;
use App\Models\Report;

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
        return Report::find($id);
    }

    public function storeReport($data)
    {
        $project = auth()->user()->project;

        $data["cheated"] = $this->ReportAuthenticationService->isValid($project, $data['qr_code_value'], $data['location_lat'], $data['location_long']);

        return Report::create($data);
    }

    public function updateReport($report, $data)
    {
        return $report->update($data);
    }
}
