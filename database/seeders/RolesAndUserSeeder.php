<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
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

        // Define roles and assign permissions
        $roles = [
            'superadmin' => $permissions,
            'admin' => $permissions,
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

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);

            // Create user for each role
            $email = str_replace(' ', '_', $roleName) . '@demo.com';
            $user = User::firstOrCreate([
                'email' => $email
            ], [
                'name' => ucwords(str_replace('_', ' ', $roleName)),
                'password' => Hash::make('password'),
                'type' => in_array($roleName, ['student']) ? 'student' : 'staff'
            ]);

            $user->assignRole($roleName);
        }
    }
}
