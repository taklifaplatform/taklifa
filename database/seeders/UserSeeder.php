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
                'name' => 'Taklifa Admin',
                'username' => 'admin',
                'email' => 'admin@taklifa.com',
                'phone_number' => '966000000000',
                'role' => 'super_admin',
                'password' => '#!@taklifa',
            ],
            [
                'name' => 'Company Owner',
                'username' => 'company_owner',
                'email' => 'company.owner@taklifa.com',
                'phone_number' => '966222222222',
                'role' => 'company_owner',
                'password' => '123456789',
            ],
            [
                'name' => 'Company Manager',
                'username' => 'company_manager',
                'email' => 'company.manager@taklifa.com',
                'phone_number' => '966333333333',
                'role' => 'company_manager',
                'password' => '123456789',
            ],
            [
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@taklifa.com',
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
