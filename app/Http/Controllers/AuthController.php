<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public $token = true;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        session(['jwt_token' => $token]);
        session(['user' => $user]);

        return response()->json([
            'success' => true,
            'data' => $user,
            'token' => $token,
        ]);
    }
}
