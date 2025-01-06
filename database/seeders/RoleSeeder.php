<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            (object)[
                'name' => 'Super Admin',
                'permissions' => [
                    'User_Accounts_View',
                    'User_Accounts_Edit',
                    'User_Accounts_Create',
                    'Clients_View',
                    'Clients_Edit',
                    'Clients_Create',
                    'Candidates_View',
                    'Candidates_Edit',
                    'Candidates_Create',
                    'Logs_View'
                ],
            ],
        ];

        foreach ($roles as $role) {
            $created_role = Role::create(['name' => $role->name]);
            foreach ($role->permissions as $permission) {
                $created_role->givePermissionTo($permission);
            }
        }
    }
}
