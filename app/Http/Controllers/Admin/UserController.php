<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FamilleProfile;
use App\Models\MamieProfile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Enregistrement d’un nouvel utilisateur
     */
    public function store(Request $request)
    {
        // ✅ Validation des champs
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,famille,mamie',
        ]);

        // ✅ Hash du mot de passe
        $validated['password'] = bcrypt($validated['password']);

        // ✅ Création de l’utilisateur
        $user = User::create($validated);

        // ✅ Création automatique du profil associé selon le rôle
        if ($user->role === 'famille') {
            FamilleProfile::firstOrCreate(['user_id' => $user->id]);
        }

        if ($user->role === 'mamie') {
            MamieProfile::firstOrCreate(['user_id' => $user->id]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé ✅');
    }

    /**
     * Formulaire d’édition d’un utilisateur
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mise à jour d’un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'role'  => 'required|in:admin,famille,mamie',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour ✅');
    }

    /**
     * Suppression d’un utilisateur
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé ❌');
    }
}
