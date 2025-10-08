<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FamilleProfile;
use App\Models\MamieProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * 🔹 Page de choix du type d'inscription
     */
    public function choose()
    {
        return view('auth.register-choice');
    }

    /**
     * 👨‍👩‍👧 Formulaire d'inscription Famille
     */
    public function createFamille()
    {
        return view('auth.famille-register');
    }

    /**
 * 👨‍👩‍👧 Enregistre une nouvelle famille
 */
public function storeFamille(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],

        'adresse' => ['required', 'string', 'max:255'],
        'ville' => ['required', 'string', 'max:255'],
        'departement' => ['required', 'string', 'max:255'],
        'arrondissement' => ['nullable', 'string', 'max:255'],
        'telephone' => ['nullable', 'string', 'max:50'],
        'nombre_enfants' => ['nullable', 'integer', 'min:0'],
        'enfants' => ['nullable', 'string', 'max:1000'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    // 👤 Création de l’utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'famille',
    ]);

    // 📷 Upload photo si présente
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('familles/photos', 'public');
    }

    // 💾 Création du profil Famille
    FamilleProfile::create([
        'user_id'        => $user->id,
        'adresse'        => $request->adresse,
        'ville'          => $request->ville,
        'departement'    => $request->departement,
        'arrondissement' => $request->arrondissement,
        'telephone'      => $request->telephone,
        'nombre_enfants' => $request->nombre_enfants,
        'enfants'        => $request->enfants,
        'photo'          => $photoPath,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->route('famille.dashboard')->with('success', 'Bienvenue sur Mamie4Family 💕');
}
/**
     * 👵 Formulaire d'inscription Mamie
     */
    public function createMamie()
    {
        return view('auth.mamie-register');
    }

   /**
     * 👵 Enregistre une nouvelle mamie
     */
    public function storeMamie(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'unique:users'],
            'password'      => ['required', 'confirmed', 'min:8'],

            'bio'           => ['nullable', 'string', 'max:1000'],
            'adresse'       => ['required', 'string', 'max:255'],
            'ville'         => ['nullable', 'string', 'max:255'],
            'departement'   => ['nullable', 'string', 'max:255'],
            'arrondissement'=> ['nullable', 'string', 'max:255'],
            'services'      => ['nullable', 'string', 'max:255'],
            'tarif'         => ['nullable', 'numeric'],
            'photo'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cni'           => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ]);

        // 👤 Création de l'utilisateur avec rôle "mamie"
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mamie',
        ]);

        // 📂 Upload des fichiers
        $photoPath = null;
        $cniPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('mamies/photos', 'public');
        }

        if ($request->hasFile('cni')) {
            // CNI stockée en privé pour sécurité
            $cniPath = $request->file('cni')->store('mamies/cni', 'private');
        }

        // 💾 Création du profil mamie
        MamieProfile::create([
            'user_id'       => $user->id,
            'photo'         => $photoPath,
            'bio'           => $request->bio,
            'adresse'       => $request->adresse,
            'ville'         => $request->ville,
            'departement'   => $request->departement,
            'arrondissement'=> $request->arrondissement,
            'services'      => $request->services,
            'tarif'         => $request->tarif,
            'cni'           => $cniPath,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('mamie.dashboard')->with('success', 'Bienvenue parmi nos Mamies 💜');
    }
}