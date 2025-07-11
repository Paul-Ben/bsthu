<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Optional: define permissions
        $permissions = [
            'manage applications',
            'admit students',
            'manage students',
            'manage courses',
            'process results',
            'manage payments',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $roles = [
            'superadmin' => Permission::all(),
            'admin' => Permission::all(),
            'admissions officer' => ['manage applications', 'admit students'],
            'exam officer' => ['process results'],
            'hod' => ['manage students', 'process results'],
            'bursar' => ['manage payments'],
            'accounts officer' => ['manage payments'],
            'IT admin' => [],
            'IT manager' => [],
            'helpdesk' => [],
            'student' => [],
        ];

        foreach ($roles as $role => $perms) {
            $r = Role::firstOrCreate(['name' => $role]);
            $r->syncPermissions($perms);
        }
    }
}
