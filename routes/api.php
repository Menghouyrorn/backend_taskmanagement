<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/getcurrentuser', [AuthController::class, 'getCurrentuser']);

        // create task folder and get

        Route::post('/createtask', [TaskController::class, 'createTask']);
        Route::get('/getalltask', [TaskController::class, 'getAllTask']);
        Route::get('/gettask/{id}', [TaskController::class, 'getOneTask']);
    });
});
