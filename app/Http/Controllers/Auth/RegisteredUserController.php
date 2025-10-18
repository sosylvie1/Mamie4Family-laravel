<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FamilleProfile;
use App\Models\MamieProfile;
use App\Models\Enfant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * 🔸 Page de choix du type d'inscription
     */
    public function choose()
    {
        return view('auth.register-choice');
    }

    // ────────────────────────────────
    // 👨‍👩‍👧 INSCRIPTION FAMILLE
    // ────────────────────────────────

    /**
     * Formulaire d’inscription Famille
     */
    public function createFamille()
    {
        return view('auth.famille-register');
    }

    /**
     * Enregistre une nouvelle famille et ses enfants
     */
    public function storeFamille(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'unique:users'],
            'password'        => ['required', 'confirmed', 'min:8'],

            'adresse'         => ['required', 'string', 'max:255'],
            'ville'           => ['required', 'string', 'max:255'],
            'departement'     => ['required', 'string', 'max:255'],
            'arrondissement'  => ['nullable', 'string', 'max:255'],
            'telephone'       => ['nullable', 'string', 'max:50'],
            'nombre_enfants'  => ['nullable', 'integer', 'min:0'],
            'photo'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'enfants'         => ['nullable', 'array'],
            'enfants.*.nom'   => ['nullable', 'string', 'max:255'],
            'enfants.*.age'   => ['nullable', 'integer', 'min:0', 'max:25'],
        ]);

        // 👤 Création de l’utilisateur
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'famille',
        ]);

        // 📸 Upload photo (si présente)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('familles/photos', 'public');
        }

        // 🏠 Création du profil Famille
        $familleProfile = FamilleProfile::create([
            'user_id'        => $user->id,
            'adresse'        => $request->adresse,
            'ville'          => $request->ville,
            'departement'    => $request->departement,
            'arrondissement' => $request->arrondissement,
            'telephone'      => $request->telephone,
            'nombre_enfants' => $request->nombre_enfants,
            'photo'          => $photoPath,
        ]);

        // 👧 Création des enfants associés
        if ($request->filled('enfants')) {
            foreach ($request->input('enfants') as $enfant) {
                if (!empty($enfant['nom'])) {
                    Enfant::create([
                        'famille_profile_id' => $familleProfile->id,
                        'nom' => $enfant['nom'],
                        'age' => $enfant['age'] ?? null,
                    ]);
                }
            }
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect()
            ->route('famille.dashboard')
            ->with('success', 'Bienvenue sur Mamie4Family 💕');
    }

    // ────────────────────────────────
    // 👵 INSCRIPTION MAMIE
    // ────────────────────────────────

    /**
     * Formulaire d’inscription Mamie
     */
    public function createMamie()
    {
        return view('auth.mamie-register');
    }

    /**
     * Enregistre une nouvelle mamie
     */
    public function storeMamie(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'unique:users'],
            'password'        => ['required', 'confirmed', 'min:8'],

            'bio'             => ['nullable', 'string', 'max:1000'],
            'adresse'         => ['required', 'string', 'max:255'],
            'ville'           => ['nullable', 'string', 'max:255'],
            'departement'     => ['nullable', 'string', 'max:255'],
            'arrondissement'  => ['nullable', 'string', 'max:255'],
            'services'        => ['nullable', 'string', 'max:255'],
            'tarif'           => ['nullable', 'numeric'],
            'photo'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cni'             => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ]);

        // 👵 Création de l’utilisateur
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mamie',
        ]);

        // 📂 Upload fichiers
        $photoPath = null;
        $cniPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('mamies/photos', 'public');
        }

        if ($request->hasFile('cni')) {
            // CNI stockée dans un dossier privé pour sécurité
            $cniPath = $request->file('cni')->store('mamies/cni', 'private');
        }

        // 💾 Création du profil mamie
        MamieProfile::create([
            'user_id'        => $user->id,
            'photo'          => $photoPath,
            'bio'            => $request->bio,
            'adresse'        => $request->adresse,
            'ville'          => $request->ville,
            'departement'    => $request->departement,
            'arrondissement' => $request->arrondissement,
            'services'       => $request->services,
            'tarif'          => $request->tarif,
            'cni'            => $cniPath,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()
            ->route('mamie.dashboard')
            ->with('success', 'Bienvenue parmi nos Mamies 💜');
    }
}
