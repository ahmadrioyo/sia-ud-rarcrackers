<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'akuntan',
            'owner',
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role]);
        }

        $permissions = [
            'view_admin',
            'view_akuntan',
            'view_owner',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        Role::findByName('admin')->givePermissionTo('view_admin');
        Role::findByName('akuntan')->givePermissionTo('view_akuntan');
        Role::findByName('owner')->givePermissionTo('view_owner');
    }
}
