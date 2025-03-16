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
        User::create([
            'name' => 'teknisi',
            'email' => 'teknisi@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '1',
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'pertamina',
            'email' => 'pertamina@gmail.com',
            'password' => Hash::make(123),
            'role_id' => '3',
        ]);
    }
}