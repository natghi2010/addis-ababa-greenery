<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use App\Http\Services\ReportSummaryService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }


    public function index()
    {
        try {

            return $this->dashboardService->getDashboardSummary();

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
