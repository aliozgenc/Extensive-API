<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionCleanupSeeder extends Seeder
{
    public function run()
    {
        // Eski izinleri silme işlemi
        Permission::where('name', 'create website')->delete();
        Permission::where('name', 'approve website')->delete();
        Permission::where('name', 'reject website')->delete();
    }
}
