<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post("login", [AuthenticationController::class, "login"])->name("login");
Route::resource("report", ReportController::class);

//group by auth
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource("history", HistoryController::class);
 //   Route::resource("report", ReportController::class);
    Route::get("logout", [AuthenticationController::class, "logout"])->name("logout");
});
