<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function listAdminUsers()
    {
        $adminRole = Role::findByName('admin');
        $adminUsers = $adminRole->users;

        foreach ($adminUsers as $adminUser) {
            echo $adminUser->name . "<br>";
        }
    }
}
