<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mamie4family.fr'], // vérifie si déjà existant
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), // ⚠️ change ce mot de passe !
                'role' => 'admin',
            ]
        );
    }
}

