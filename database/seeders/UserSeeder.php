<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pengawas 1',
            'email' => 'pengawas@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengawas',
        ]);

        User::create([
            'name' => 'Atlet 1',
            'email' => 'atlet@example.com',
            'password' => Hash::make('password'),
            'role' => 'atlet',
        ]);
    }
}
