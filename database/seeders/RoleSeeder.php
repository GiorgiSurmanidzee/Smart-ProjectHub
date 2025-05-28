<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view analytics',
            'view logs',

            'manage users',
            'assign roles',
            'invite users',

            'create projects',
            'edit projects',
            'delete projects',
            'view all projects',

            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            'view assigned tasks',

            'comment on tasks',
            'upload files',

            'view project status',
            'comment on project',

            'view own projects',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $admin->givePermissionTo(Permission::all());

        $projectManager = Role::firstOrCreate(['name' => 'project manager', 'guard_name' => 'api']);
        $projectManager->givePermissionTo([
            'create projects',
            'edit projects',
            'delete projects',
            'assign tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'invite users',
            'view all projects',
            'view analytics',
            'view logs',
        ]);

        $teamMember = Role::firstOrCreate(['name' => 'team member', 'guard_name' => 'api']);
        $teamMember->givePermissionTo([
            'view assigned tasks',
            'edit tasks',
            'comment on tasks',
            'upload files',
            'view own projects',
        ]);

        $client = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'api']);
        $client->givePermissionTo([
            'view project status',
            'comment on project',
        ]);
    }
}
