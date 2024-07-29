<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\Task\TaskResource;


class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required'
        ]);

        try {
            $taskcreate = Task::create($request->all());

            if ($taskcreate) {
                return response()->json([
                    'message' => 'success',
                    'code' => 0,
                    'data' => $taskcreate,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'error',
                    'code' => 1,
                    'data' => []
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    public function getAllTask()
    {
        try {
            $taskdata = Task::all();

            return response()->json([
                'message' => 'success',
                'code' => 0,
                'data' => $taskdata,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    public function getOneTask($id)
    {
        try {
            $findtaskdata = Task::find($id);
            if ($findtaskdata) {
                return response()->json([
                    'message' => 'success',
                    'data' => $findtaskdata,
                    'code' => 0
                ], 200);
            } else {
                return response()->json([
                    'message' => 'not found',
                    'data' => [],
                    'code' => 1
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'code' => 1,
                'data' => [],
            ], 500);
        }
    }
}
