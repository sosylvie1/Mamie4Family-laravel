<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    /**
     * Affiche le formulaire de modification du profil admin
     */
    public function edit()
    {
        $admin = Auth::user(); // récupère l’admin connecté
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Met à jour le profil admin
     */
    public function update(Request $request)
    {
        $admin = Auth::user();

        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Mise à jour des infos
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil mis à jour avec succès ✅');
    }
}
