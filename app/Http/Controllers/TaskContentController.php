<?php

namespace App\Http\Controllers;

use App\Models\TaskContent;
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
            $taskcontentdataone = TaskContent::find($id)::with('getwithTaskFolder')->get();
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
                'message' => 'server error',
                'code' => 1,
                'data' => []
            ]);
        }
    }


    public function getallTaskContent()
    {
        try {
            $data = TaskContent::with('getwithTaskFolder')->get();

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
}
