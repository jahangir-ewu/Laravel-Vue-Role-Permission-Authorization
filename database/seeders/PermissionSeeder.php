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

        // INFO: To customize permissions for different application segments or user types (e.g., admin panel, API, customer portal),
        // you should define and use different 'guard_name's here and in RoleSeeder.
        // Ensure these guard names are also defined in config/auth.php and uncommented in config/permission.php's 'guards' array.
        // For example, to add permissions for an API guard:
        // Permission::firstOrCreate(['name' => "order.view_api", 'guard_name' => 'api']);
        foreach ($permissions as $group => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$group.$action",
                    'guard_name' => 'web', // Default guard. For other guards (e.g., 'api', 'admin_panel'), specify them explicitly.
                ]);
            }
        }

        // API Guard Permissions
        $apiPermissions = [
            'order_api' => ['view', 'list', 'status_update'],
            'product_api' => ['view', 'list'],
        ];

        foreach ($apiPermissions as $group => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$group.$action",
                    'guard_name' => 'api', // Explicitly for the API guard
                ]);
            }
        }
    }
}
