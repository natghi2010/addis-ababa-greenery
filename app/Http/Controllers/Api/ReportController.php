<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ReportingService;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportingService $reportingService)
    {
        $this->reportService = $reportingService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $data = $this->reportService->getReports();

            return response()->success('Successful operation', $data);

        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/report",
     *      operationId="Report",
     *      tags={"Report"},
     *      summary="Report",
     *      description="Report",
     *  @OA\RequestBody(
     *    required=true,
     *    description="Post Reporting Data",
     *    @OA\JsonContent(
     *       required={"reporter_id","image","location_lat","location_long"},
     *       @OA\Property(property="reporter_id", type="integer", format="integer", example="1"),
     *       @OA\Property(property="image", type="string", format="string", example="base64:43897594329udoiadfy348734"),
     *       @OA\Property(property="location_lat", type="string", format="string", example="9.23243324"),
     *       @OA\Property(property="location_long", type="string", format="string", example="9.77243324"),
     *    ),
     * ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),

     * )
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $this->reportService->storeReport($data);

            return response()->success();

        } catch (\Throwable $th) {

            return response()->error($th->getMessage(), 500);

        }
    }


    public function show($id)
    {
        try {

            $data = $this->reportService->getReportDetail($id);
            return response()->success($data);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        try {
            $data = $request->all();
            $this->reportService->updateReport($report, $request);
            return response()->success('Successful operation', $data);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
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
}
