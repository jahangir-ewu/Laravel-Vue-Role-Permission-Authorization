<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'user' => ['view', 'create', 'edit', 'delete'],
            'role' => ['view', 'create', 'edit', 'delete'],
            'permission' => ['view', 'create', 'edit', 'delete'],
            'project' => ['view', 'create', 'edit', 'delete', 'assign'],
            // Add more groups as needed
        ];

        foreach ($permissions as $group => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$group.$action",
                    'guard_name' => 'web', // or 'admin', 'customer' if needed
                ]);
            }
        }
    }
}
