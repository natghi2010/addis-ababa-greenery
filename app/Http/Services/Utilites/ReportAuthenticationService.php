<?php

namespace App\Http\Services\Utilites;

class ReportAuthenticationService
{
    public function __construct()
    {
        $this->allowedReportingRadius = 100;
    }

    public function location_check($project_location_lat, $project_long, $location_lat, $location_long)
    {
        $earthRadius = 6371000;
        $dLat = deg2rad($location_lat - $project_location_lat);
        $dLon = deg2rad($location_long - $project_long);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($project_location_lat)) * cos(deg2rad($location_lat)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return $distance <= $this->allowedReportingRadius;
    }

    public function qrCodeCheck($project, $qr_code_value)
    {
        return $project->id == $qr_code_value;
    }

    public function isValid($project, $qr_code_value, $location_lat, $location_long)
    {
        return $this->location_check($project->location_lat, $project->location_long, $location_lat, $location_long) && $this->qrCodeCheck($project, $qr_code_value);
    }
}
