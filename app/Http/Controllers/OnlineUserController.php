<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineUserController extends Controller
{
    public function getUserInfo(Request $request)
    {
        // Kullanıcının ID'sini alma
        $userID = $request->user()->id;

        // Kullanıcının token'ını alma
        $token = $request->bearerToken();

        return response()->json([
            'user_id' => $userID,
            'token' => $token,
        ]);
    }
}
