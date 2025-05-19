<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);


        \App\Models\User::factory()->create([
        'name' => 'Test Admin',
        'email' => 'testnihir@gmail.com',
        'password' => bcrypt('password'),
        ])->assignRole($adminRole);

        \App\Models\User::factory()->create([
        'name' => 'Test Editor',
        'email' => 'testeditor@gmail.com',
        'password' => bcrypt('password'),
        ])->assignRole($editorRole);

        \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'testuser@gmail.com',
        'password' => bcrypt('password'),
        ])->assignRole($userRole);

        $adminPermissions = Permission::all(); // Assuming admins have all permissions

        $editorPermissions = Permission::whereIn('name', [
        'product-access',
        'product-create',
        'product-delete',
        // Add more permissions specific to Editors here
        ])->get();

        $userPermissions = Permission::whereIn('name', [
        'product-create',
        'product-access',
        // Add more permissions specific to Members here
        ])->get();

        $adminRole->syncPermissions($adminPermissions);

        // Assign permissions to the Editor role
        $editorRole->syncPermissions($editorPermissions);

        // Assign permissions to the Member role
        $userRole->syncPermissions($userPermissions);
    }
}
