<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // "user" rolünü oluşturun veya alın
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Kullanıcıya "user" rolünü atayın
        $user->assignRole($userRole);

        $token = $user->createToken('api-token')->plainTextToken;

        return response(['token' => $token], 201);
    }
}
