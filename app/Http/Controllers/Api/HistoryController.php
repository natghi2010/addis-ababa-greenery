<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
     /**
     * @OA\Get(
      *      path="/api/history/",
     *      operationId="getHistoryList",
     *      tags={"History"},
     *      summary="Get List of History",
     *      description="Returns list of History",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *  *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *    ),
     *       ),
     *
     *       @OA\Response(response=400, description="Bad request"),
     *
     *     )
     *
     * Returns list of projects
     */

    public function index()
    {
        //
    }

    /**
     *  @OA\Get(

     *      operationId="gethistory",
     *      path="/api/history/{id}",
     *        tags={"History"},
     *      summary="Get history by ID",
     *      description="Get history by Id",
     *      security={
     *          {"bearer_token":{}},
     *      },
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Search for one history",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="Error"
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *      ),
     *  )
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
