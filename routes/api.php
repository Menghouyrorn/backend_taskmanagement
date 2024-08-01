<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskContentController;
use App\Http\Controllers\ListDateController;
use App\Http\Controllers\TaskController;
use App\Models\Auth;
use App\Models\TaskContent;
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
        Route::put('/updatetaskfolder/{id}', [TaskController::class, 'updatetaskfolder']);
        Route::delete('/deletetaskfolder/{id}', [TaskController::class, 'deleteTaskFolder']);

        // create task content and get task content

        Route::get('/getalltaskcontent', [TaskContentController::class, 'getallTaskContent']);
        Route::get('/getonetaskcontent/{id}', [TaskContentController::class, 'getoneTaskContent']);
        Route::post('/createtaskcontent', [TaskContentController::class, 'createTaskContent']);
        Route::put('/updatetaskcontent/{id}', [TaskContentController::class, 'updateTaskcontent']);
        Route::delete('/deletetaskcontent/{id}', [TaskContentController::class, 'deleteTaskContent']);

        Route::get('/gettaskcontentbydate',[TaskContentController::class,'gettaskcentbyDate']);

        //  find task content in task folder
        Route::get('/taskcontentinfolder', [TaskController::class, 'findTaskContent']);

        // get task in user id

        Route::get('/getTaskInUser/{id}', [AuthController::class, 'getTaskInUser']);
    });
});
