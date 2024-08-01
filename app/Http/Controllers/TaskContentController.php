<?php

namespace App\Http\Controllers;


use App\Models\TaskContent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskContentController extends Controller
{
    public function createTaskContent(Request $request)
    {
        $request->validate([
            'task_id' => 'required',
            'title' => 'required',
            'issuccess' => 'required',
            'start_on' => 'required',
            'end_on' => 'required'
        ]);

        try {
            $taskcontent = TaskContent::create($request->all());

            if ($taskcontent) {
                return response()->json([
                    'message' => 'success',
                    'data' => $taskcontent,
                    'code' => 0
                ], 200);
            } else {
                return response()->json([
                    'message' => 'error',
                    'data' => [],
                    'code' => 1
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

    public function getoneTaskContent($id)
    {
        try {
            $taskcontentdataone = TaskContent::find($id);
            $taskcontentdataone->getonlyOneTaskcontent;
            if ($taskcontentdataone) {
                return response()->json([
                    'message' => 'success',
                    'data' => $taskcontentdataone,
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
                'data' => []
            ]);
        }
    }

    // update task content

    public function updateTaskcontent(Request $request, $id)
    {
        try {
            $updatedata = TaskContent::where('id', $id)->update($request->all());
            if ($updatedata) {
                return response()->json([
                    'message' => 'update success',
                    'data' => $updatedata,
                    'code' => 0
                ], 201);
            } else {
                return response()->json([
                    'message' => 'update error',
                    'data' => [],
                    'code' => 1
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 1
            ], 500);
        }
    }

    // delete task content

    public function deleteTaskContent($id)
    {
        try {
            $datadelete = TaskContent::where('id', $id)->delete();
            if ($datadelete) {
                return response()->json([
                    'message' => 'delete success',
                    'code' => 0,
                    'data' => $datadelete
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
                'data' => [],
                'code' => 1
            ], 500);
        }
    }


    public function getallTaskContent()
    {
        try {
            $data = TaskContent::orderby('start_on','desc')->with('getwithTaskFolder')->get();

            return response()->json([
                'message' => 'success',
                'data' => $data,
                'code' => 0
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 1
            ], 500);
        }
    }

    public function gettaskcentbyDate()
    {
        try {

            $data = TaskContent::whereDate("start_on", ">=", Carbon::now())
                ->orderBy('start_on', 'asc')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->start_on)->format('d-M-Y');
                });

            return response()->json([
                'message' => 'success',
                'code' => 0,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 1
            ]);
        }
    }
}
