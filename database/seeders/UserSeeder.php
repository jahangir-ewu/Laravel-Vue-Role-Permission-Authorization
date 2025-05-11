<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (web guard)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        $admin->assignRole('admin');

        // Manager user (web guard)
        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            ['name' => 'Manager User', 'password' => bcrypt('password')]
        );
        $manager->assignRole('manager');

        // Customer user (customer guard)
        $employee = \App\Models\User::firstOrCreate(
            ['email' => 'customer@example.com'],
            ['name' => 'Customer User', 'password' => bcrypt('password')]
        );
        $employee->assignRole('customer');
    }
}
