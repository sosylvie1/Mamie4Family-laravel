<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FamilleProfile;
use App\Models\MamieProfile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     */
    public function run(): void
    {
        // ==========================
        // 👑 ADMIN
        // ==========================
        User::updateOrCreate(
            ['email' => 'admin@mamie4family.fr'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // ==========================
        // 👨‍👩‍👧 FAMILLES
        // ==========================
        $famille1 = User::updateOrCreate(
            ['email' => 'famille1@test.fr'],
            [
                'name' => 'Famille Dupont',
                'password' => Hash::make('password123'),
                'role' => 'famille',
            ]
        );

        FamilleProfile::updateOrCreate(
            ['user_id' => $famille1->id],
            [
                'adresse'        => '12 rue des Lilas',
                'ville'          => 'Paris',
                'departement'    => '75',
                'arrondissement' => '15e',
                'telephone'      => '0102030405',
                'nombre_enfants' => 2,
                'enfants'        => 'Emma, Lucas',
                'photo'          => null,
            ]
        );

        $famille2 = User::updateOrCreate(
            ['email' => 'famille2@test.fr'],
            [
                'name' => 'Famille Martin',
                'password' => Hash::make('password123'),
                'role' => 'famille',
            ]
        );

        FamilleProfile::updateOrCreate(
            ['user_id' => $famille2->id],
            [
                'adresse'        => '34 avenue Victor Hugo',
                'ville'          => 'Bordeaux',
                'departement'    => '33',
                'arrondissement' => 'Centre',
                'telephone'      => '0607080910',
                'nombre_enfants' => 3,
                'enfants'        => 'Léa, Tom, Sarah',
                'photo'          => null,
            ]
        );

        // ==========================
        // 👵 MAMIES
        // ==========================
        $mamie1 = User::updateOrCreate(
            ['email' => 'mamie1@test.fr'],
            [
                'name' => 'Mamie Jeanne',
                'password' => Hash::make('password123'),
                'role' => 'mamie',
            ]
        );

        MamieProfile::updateOrCreate(
            ['user_id' => $mamie1->id],
            [
                'photo'         => null,
                'bio'           => 'Mamie sympa, adore garder les enfants et faire des gâteaux.',
                'adresse'       => '15 rue des Lavandes',
                'ville'         => 'Nice',
                'departement'   => '06',
                'arrondissement'=> 'Ouest',
                'services'      => 'Garde d’enfants, cuisine, aide aux devoirs',
                'tarif'         => 12.5,
                'cni'           => null,
            ]
        );

        $mamie2 = User::updateOrCreate(
            ['email' => 'mamie2@test.fr'],
            [
                'name' => 'Mamie Marie',
                'password' => Hash::make('password123'),
                'role' => 'mamie',
            ]
        );

        MamieProfile::updateOrCreate(
            ['user_id' => $mamie2->id],
            [
                'photo'         => null,
                'bio'           => 'Disponible pour garder vos enfants et raconter des histoires passionnantes.',
                'adresse'       => '8 rue des Jasmins',
                'ville'         => 'Lyon',
                'departement'   => '69',
                'arrondissement'=> 'Centre',
                'services'      => 'Lecture, promenade, jeux éducatifs',
                'tarif'         => 10.0,
                'cni'           => null,
            ]
        );
    }
}
