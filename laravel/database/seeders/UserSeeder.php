<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ariel@mail.com'],
            [
                'name' => 'Ariel',
                'password' =>Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'alfonso@mail.com'],
            [
                'name' => 'Alfonso',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'nacho@mail.com'],
            [
                'name' => 'Nacho',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}