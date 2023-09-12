<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create-Speciality', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Speciality', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Speciality', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Speciality', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Restore-Speciality', 'guard_name' => 'admin']);
    }
}
