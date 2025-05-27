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
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            'unpublish articles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        $writer = Role::firstOrCreate([
            'name' => 'writer',
            'guard_name' => 'api'
        ]);
        $writer->givePermissionTo(['create articles', 'edit articles']);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);
        $admin->givePermissionTo(Permission::all());

        $editor = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'api'
        ]);
        $editor->givePermissionTo(['publish articles', 'unpublish articles']);
    }
}
