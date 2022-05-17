<?php

namespace App\Http\Services;

use App\Models\Report;

class ReportingService
{
    public function getReports(){
      return Report::all();
    }

    public function getReportDetail($id){
        return Report::find($id);
    }

    public function storeReport($data){
        return Report::create($data);
    }
    public function updateReport($report,$data){
        return $report->update($data);
    }
}
