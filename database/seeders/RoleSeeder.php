<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Role (web guard)
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
       // $admin->syncPermissions(Permission::where('guard_name', 'web')->pluck('name'));
        $admin->givePermissionTo(Permission::all());

        // Manager Role (web guard)
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $manager->syncPermissions(Permission::whereIn('name', [
            'user.view', 'project.view', 'project.edit', 'project.assign'
        ])->pluck('name'));

        // Customer Role (customer guard)
        $employee = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        $employee->givePermissionTo(['project.view', 'project.create', 'project.edit']);
        //$employee->givePermissionTo(['project.view', 'project.create', 'project.edit']);
    }
}
