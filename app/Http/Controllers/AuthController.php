<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            $email = $request->email;
            $password = $request->password;
            $user = Auth::where('email', $email)->first();

            if ($user) {

                if (Hash::check($password, $user->password)) {

                    $token = $user->createToken('token')->plainTextToken;

                    return response()->json([
                        'message' => 'success',
                        'code' => 0,
                        'data' => $user,
                        'token' => $token
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'error',
                        'code' => 1,
                        'data' => [],
                        'token' => ''
                    ], 404);
                }
            } else {
                return response()->json([
                    'message' => 'not found',
                    'code' => 1,
                    'data' => [],
                    'token' => ''
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'code' => 1,
                'data' => [],
                'token' => ''
            ], 500);
        }
    }

    // create user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $email = $request->email;
            $password = $request->password;
            $name = $request->name;

            $checkuser = Auth::where('email', $email)->first();

            if (!$checkuser) {
                $passwordEncrypt = bcrypt($password);

                $user = Auth::create([
                    'email' => $email,
                    'password' => $passwordEncrypt,
                    'name' => $name
                ]);

                return response()->json([
                    'message' => 'success',
                    'code' => 0,
                    'data' => $user
                ], 200);
            } else {
                return response()->json([
                    'message' => 'user is exit',
                    'code' => 1,
                    'data' => []
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'code' => 1,
                'data' => []
            ], 500);
        }
    }

    // get current user
    public function getCurrentuser()
    {
        $currentuser = auth()->user();
        return response()->json([
            'message' => 'success',
            'code' => 0,
            'data' => $currentuser
        ], 200);
    }
}
