<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create records in roles table
        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $userRole = Role::create(['name' => 'User']);

        //create records in permission table
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        //create records in roles_has_permission table
        $adminRole->givePermissionTo([
            'create',
            'edit',
            'delete',
        ]);

        $managerRole->givePermissionTo([
            'create',
            'edit',
            'delete',
        ]);
        $userRole->givePermissionTo([
            'edit',
        ]);
    }
}
