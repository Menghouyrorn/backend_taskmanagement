<?php

namespace App\Http\Controllers;

use App\Models\task_content;
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
            $taskcontent = task_content::create($request->all());

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
                'message' => 'server error',
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    public function getoneTaskContent($id)
    {
        try {
            $taskcontentdataone = task_content::find($id);
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
            $data = task_content::all();

            return response()->json([
                'message' => 'success',
                'data' => $data,
                'code' => 0
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'data' => [],
                'code' => 1
            ], 500);
        }
    }
}
