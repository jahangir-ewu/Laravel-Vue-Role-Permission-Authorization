<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $permissionsGroups = [
            'user' => ['view','create','update','delete'],
            'project' => ['view', 'create', 'edit', 'delete'],
            'role' => ['view','create','update','delete'],
            'permission' => ['view','create','update','delete'],
        ];
        $permissions = [];
        foreach ($permissionsGroups as $group => $actions) {
            foreach ($actions as $action) {
                //$permissions[] = $group . '-' . $action;
                Permission::firstOrCreate(['name' => "$group.$action"]);
            }
        }
        // Create roles and assign existing permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);

        $admin->givePermissionTo(Permission::all());
        //$admin ->syncPermissions(Permission::all());

        $manager->givePermissionTo(['user.view', 'user.create']);
        $manager->givePermissionTo(['project.view', 'project.create', 'project.edit']);

        $employee->givePermissionTo(['user.view']);
        $employee->givePermissionTo(['project.view']);

        $user = User::where('id', 1)->first();
        if ($user) {
            $user->assignRole('admin');
        } else {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'abcd@demo.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('admin'); 
        }   
        // Create a user and assign the role
        $user = User::where('id', 2)->first();
        if ($user) {
            $user->assignRole('manager');
        } else {
            $user = User::factory()->create([
                'name' => 'Manager',
                'email' => 'manager@demo.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('manager');
        }    
        // Create a user and assign the role
        $user = User::where('id', 3)->first();
        if ($user) {
            $user->assignRole('employee');
        } else {
            $user = User::factory()->create([
                'name' => 'Employee',
                'email' => 'employees@demo.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('employee');
        }

    }
}
