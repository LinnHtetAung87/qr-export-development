<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-access',
            'role-create',
            'role-edit',
            'role-delete',
            'user-access',
            'user-create',
            'user-edit',
            'user-delete',
            'permission-access',
            'permission-create',
            'permission-edit',
            'permission-delete',


            'dashboard-access',

            'product-access',
            'product-create',
            'product-edit',
            'product-delete'
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

    }
}
