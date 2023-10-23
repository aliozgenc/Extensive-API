<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
    }
}
