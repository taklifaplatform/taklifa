<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Sawaeed Admin',
                'username' => 'admin',
                'email' => 'admin@sawaeed.com',
                'phone_number' => '966000000000',
                'role' => 'super_admin',
                'password' => '#!@sawaeed',
            ],
            [
                'name' => 'Solo Driver',
                'username' => 'solo_driver',
                'email' => 'solo.driver@sawaeed.com',
                'phone_number' => '966111111111',
                'role' => 'solo_driver',
                'password' => '123456789',
            ],
            [
                'name' => 'Company Owner',
                'username' => 'company_owner',
                'email' => 'company.owner@sawaeed.com',
                'phone_number' => '966222222222',
                'role' => 'company_owner',
                'password' => '123456789',
            ],
            [
                'name' => 'Company Manager',
                'username' => 'company_manager',
                'email' => 'company.manager@sawaeed.com',
                'phone_number' => '966333333333',
                'role' => 'company_manager',
                'password' => '123456789',
            ],
            [
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@sawaeed.com',
                'phone_number' => '966444444444',
                'role' => 'customer',
                'password' => '123456789',
            ],

        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'phone_number' => $user['phone_number'],
                    'password' => bcrypt($user['password']),
                ]
            )->assignRole($user['role']);
        }
    }
}
