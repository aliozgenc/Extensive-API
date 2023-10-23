<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token');

            return response()->json(['message' => 'Logged in successfully', 'token' => $token->plainTextToken], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }

        return response()->json(['message' => 'Logged out']);
    }
}
