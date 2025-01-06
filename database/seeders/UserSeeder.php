<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::create([
            'name' => 'Jefferson P. Flordeliza',
            'email' => 'jefferson.flordeliza@gmail.com',
            'password' => Hash::make('Demo123!?'),
            'status' => 1
        ]);

        $super_admin->assignRole('Super Admin');
    }
}
