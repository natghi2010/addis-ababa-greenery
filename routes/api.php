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
use App\Http\Controllers\Api\ProjectTypeController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;

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

Route::get("dev", function () {
    return User::all();
});

Route::post("login", [AuthenticationController::class, "login"])->name("login");


//group by auth
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource("report", ReportController::class);
    Route::resource("history", HistoryController::class);
    Route::get("logout", [AuthenticationController::class, "logout"])->name("logout");
});


//Test
Route::prefix("v1")->group(function () {

    Route::apiResource('/dashboard', DashboardController::class);
    Route::apiResource('/project', ProjectController::class);
    Route::get('/project-types', [ProjectTypeController::class, "index"]);
    Route::get('/project-types/subcity/{id}', [ProjectController::class, "getProjectTypesBySubcity"]);
    Route::get('/project-types/subcity/{id}/{project_type_id}', [ProjectController::class, "getProjectsBySubcity"]);
    Route::apiResource('/user', UserController::class);
    Route::get('/getProjectsByProjectType/{project_type_id}', [ProjectController::class, 'getProjectsByProjectType']);
    Route::get('form-options/project', [ProjectController::class, "getProjectFormOptions"]);
    Route::apiResource('/project-type', ProjectType::class);

    Route::apiResource('/tasks', TaskController::class);
});
