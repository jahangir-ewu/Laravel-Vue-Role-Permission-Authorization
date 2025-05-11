<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('local')) {
            // 🔥 Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // 🔄 Truncate Spatie tables
            DB::table('role_has_permissions')->truncate();
            DB::table('model_has_permissions')->truncate();
            DB::table('model_has_roles')->truncate();
            Permission::truncate();
            Role::truncate();
            User::truncate();

            // ✅ Enable foreign key checks back
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // User::factory(10)->create();
        $this->call([
        PermissionSeeder::class,
        RoleSeeder::class,
        UserSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
