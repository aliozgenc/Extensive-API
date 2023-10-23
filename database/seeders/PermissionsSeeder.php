<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Roller oluştur
        $adminRole = Role::updateOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
        $userRole = Role::updateOrCreate(['name' => 'user'], ['guard_name' => 'web']);

        // İzinleri tanımla ve roller ile ilişkilendir
        Permission::updateOrCreate(['name' => 'create website'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'update website'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'delete website'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'add own website'], ['guard_name' => 'web']); // Yeni izin
        Permission::updateOrCreate(['name' => 'update own website'], ['guard_name' => 'web']); // Adminin kendi websitelerini güncelleme izni
        Permission::updateOrCreate(['name' => 'reject website'], ['guard_name' => 'web']); // Adminin websiteleri reddetme izni
        Permission::updateOrCreate(['name' => 'approve website'], ['guard_name' => 'web']);
        // Admin rolüne tüm izinleri atayın
        $adminRole->givePermissionTo(Permission::all());

        // User rolüne sadece kendi websitelerini güncelleme, silme ve kendi websitelerini eklemek için izinlerini atayın
        $userRole->givePermissionTo(['update website', 'delete website', 'add own website']); // Güncellenen izinler
    }
}
