<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users; // Sesuaikan dengan nama model Anda
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i=1; $i <= 1; $i++) {
            Users::create([
                'name'      => 'Admin IT '.$i,
                'username'  => 'adminit'.$i,
                'email'     => 'adminit@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'Admin IT'
            ]);
        }
    }
}
