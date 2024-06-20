<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'user' => 'Ahmad Maulana Subandrio',
                'password' => Hash::make('inipassword'),
            ],
            [
                'name' => 'akuntan',
                'user' => 'Ahmad Subandrio',
                'password' => Hash::make('inipassword'),
            ],
            [
                'name' => 'owner',
                'user' => 'Maulana Subandrio',
                'password' => Hash::make('inipassword'),
            ],
            [
                'name' => 'akuntan',
                'user' => 'bangla',
                'password' => Hash::make('inipassword'),
            ],
            [
                'name' => 'owner',
                'user' => 'banglaa',
                'password' => Hash::make('inipassword'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(['user' => $userData['user']], [
                'name' => $userData['name'],
                'user' => $userData['user'],
                'password' => $userData['password'],
            ]);

            $user->assignRole($userData['name']);
        }
    }
}
