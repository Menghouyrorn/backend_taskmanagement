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
            $taskdata = Task::with('getwithuser')->get();

            return response()->json([
                'message' => 'success',
                'code' => 0,
                'data' => $taskdata,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    public function getOneTask($id)
    {
        try {
            $findtaskdata = Task::find($id);
            $findtaskdata->getwithuser;
            $findtaskdata->findtaskContent;
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
                'message' => $e->getMessage(),
                'code' => 1,
                'data' => [],
            ], 500);
        }
    }

    // update task folder

    public function updatetaskfolder(Request $request, $id)
    {
        try {
            $dataupdate = Task::where('id', $id)->update($request->all());

            if ($dataupdate) {
                return response()->json([
                    'message' => 'update success',
                    'code' => 0,
                    'data' => $dataupdate
                ], 200);
            } else {
                return response()->json([
                    'message' => 'not found',
                    'code' => 1,
                    'data' => []
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    // delete task controller

    public function deleteTaskFolder($id)
    {
        try {
            $datadelete = Task::where('id', $id)->delete();
            if ($datadelete) {
                return  response()->json([
                    'message' => 'delete success',
                    'data' => [],
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
                'message' => $e->getMessage(),
                'code' => 0,
                'data' => []
            ], 500);
        }
    }

    public function findTaskContent()
    {
        try {
            $data = Task::with('findtaskContent')->get();

            if ($data) {
                return response()->json([
                    'message' => 'success',
                    'data' => $data,
                    'code' => 0
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 1,
                'data' => []
            ], 500);
        }
    }
}
