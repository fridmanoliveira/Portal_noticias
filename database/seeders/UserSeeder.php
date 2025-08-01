<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Deivison Santos',
            'email' => 'deivison@gmail.com',
            'password' => Hash::make('123456'), // senha segura criptografada
        ]);
    }
}

