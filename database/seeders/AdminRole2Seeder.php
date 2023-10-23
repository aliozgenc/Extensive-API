<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRole2Seeder extends Seeder
{
    public function run()
    {
        // "admin" rolünü oluşturun ve "web" guard ile ilişkilendirin
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        // Daha fazla işlem yapabilirsiniz (örneğin, admin kullanıcılarına bu rolü atayabilirsiniz)
    }
}
