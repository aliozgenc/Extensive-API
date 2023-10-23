<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignCreateWebsitePermissionSeeder extends Seeder
{
    public function run()
    {
        // İzni oluşturun veya bulun
        $permission = Permission::firstOrCreate(['name' => 'create website']);

        // Tüm kullanıcılara izni atayın
        $users = User::all();
        foreach ($users as $user) {
            $user->givePermissionTo($permission);
        }
    }
}
