<?php

namespace App\Http\Services;

class DashboardService
{
    protected $reportSummaryService;

    public function __construct(ReportSummaryService $reportSummaryService)
    {
        $this->reportSummaryService = $reportSummaryService;
    }

    public function getDashboardSummary()
    {
        return ["overall_progress"=>$this->reportSummaryService->getOverAllProgress(),
                "project_type_summary"=>$this->reportSummaryService->getProjectTypeSummary(),
                "milestone_progress"=>$this->reportSummaryService->getProjectMilestone(1),
                "getProjectSummaryBySubcity"=>$this->reportSummaryService->getProjectSummaryBySubcity(),
               ];



    }

    public function getProjectTypeSummary()
    {
        return $this->reportSummaryService->getProjectTypeSummary();
    }


}
