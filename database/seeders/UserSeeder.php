<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1122'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'Adnan Vendor',
                'email' => 'adnan@gmail.com',
                'password' => Hash::make('1122'),
                'role' => 'vendor',
                'status' => 'active'
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('1122'),
                'role' => 'user',
                'status' => 'active'
            ]
        ]);
    }
}
