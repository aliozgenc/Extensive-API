<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // User modelini kullanmak için ekledik.

class UserController extends Controller
{
    // Diğer işlemler

    public function createAdmin()
    {
        $admin = new User();
        $admin->name = 'Admin Nameee';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('adminpassword');
        $admin->save();

        // Admin rolünü atayın
        $admin->assignRole('admin');

        return 'Admin oluşturuldu.';
    }

    // Diğer işlemler
}
