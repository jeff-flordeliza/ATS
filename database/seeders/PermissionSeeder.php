<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
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
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
