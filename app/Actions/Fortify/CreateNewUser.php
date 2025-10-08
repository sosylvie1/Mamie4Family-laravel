<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\FamilleProfile;
use App\Models\MamieProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input): User
    {
        // Validation basique
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,famille,mamie'],
        ])->validate();

        // Création de l'utilisateur
        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
            'role'     => $input['role'],
        ]);
//profil famille
       if ($user->role === 'famille') {
    $photoPath = isset($input['photo']) && $input['photo'] instanceof \Illuminate\Http\UploadedFile
        ? $input['photo']->store('familles/photos', 'public')
        : null;

    // Création du profil Famille
        FamilleProfile::create([
            'user_id' => $user->id,
            'adresse' => $input['adresse'],
            'ville' => $input['ville'],
            'arrondissement' => $input['arrondissement'] ?? null,
            'departement' => $input['departement'],
            'telephone' => $input['telephone'],
            'nombre_enfants' => $input['nombre_enfants'] ?? null,
            'enfants' => $input['enfants'] ?? null,
            'photo' => $photoPath,
        ]);

        return $user;
    }



        // Profil Mamie
        if ($user->role === 'mamie') {
            // Gestion upload photo
            $photoPath = isset($input['photo']) && $input['photo'] instanceof \Illuminate\Http\UploadedFile
                ? $input['photo']->store('mamies/photos', 'public')
                : null;

            // Gestion upload CNI
            $cniPath = isset($input['cni']) && $input['cni'] instanceof \Illuminate\Http\UploadedFile
                ? $input['cni']->store('mamies/cni', 'private')
                : null;

            MamieProfile::create([
                'user_id'  => $user->id,
                'ville'    => $input['ville'] ?? null,
                'bio'      => $input['bio'] ?? null,
                'services' => $input['services'] ?? null,
                'tarif'    => $input['tarif'] ?? null,
                'cni'      => $cniPath,
                'photo'    => $photoPath,
            ]);
        }

        return $user;
    }
}
