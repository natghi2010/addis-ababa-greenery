<?php

use App\Models\User;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("dev",function(){
   return User::all();
});

Route::post("login", [AuthenticationController::class, "login"])->name("login");


//group by auth
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource("report", ReportController::class);
    Route::resource("history", HistoryController::class);
 //   Route::resource("report", ReportController::class);
    Route::get("logout", [AuthenticationController::class, "logout"])->name("logout");
});


//Test
Route::prefix("v1")->group(function(){
    Route::apiResource('/dashboard', DashboardController::class);
    Route::apiResource('/project', ProjectController::class);
    Route::apiResource('/project-type', ProjectType::class);
});
