<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminProfile;

class AdminProfileController extends Controller
{
    /**
     * Affiche le profil admin
     */
    public function show()
    {
        $admin = Auth::user();
        $profile = $admin->adminProfile;
        return view('admin.profile.show', compact('admin', 'profile'));
    }

    /**
     * Formulaire d’édition du profil admin
     */
    public function edit()
    {
        $admin = Auth::user();
        $profile = $admin->adminProfile;
        return view('admin.profile.edit', compact('admin', 'profile'));
    }

    /**
     * Met à jour le profil admin
     */
    public function update(Request $request)
    {
        $admin = Auth::user();

        // ✅ Validation (tout en anglais pour cohérence BDD)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:150',
            'postal_code' => 'nullable|string|max:10',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // ✅ Mise à jour des infos de base de l'utilisateur
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        // ✅ Mise à jour ou création du profil admin
        $admin->adminProfile()->updateOrCreate(
            ['user_id' => $admin->id],
            [
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'department' => $validated['department'] ?? null,
                'position' => $validated['position'] ?? null,
            ]
        );

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Profil administrateur mis à jour avec succès ✅');
    }

    /**
     * Supprime uniquement les informations du profil (pas le compte)
     */
    public function destroy()
    {
        $admin = Auth::user();
        $profile = $admin->adminProfile;

        if ($profile) {
            $profile->delete();
        }

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Les informations du profil ont été supprimées 🗑️');
    }
}
