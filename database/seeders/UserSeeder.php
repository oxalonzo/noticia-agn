<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crea el primer usuario con rol admin
         User::create([
            'name' => 'Admin',
            'email' => 'correo@correo.com',
            'password' => Hash::make('agn123456'), // Bcrypt
            'rol' => 1,
        ]);
    }
}
