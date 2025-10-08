<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FamilleProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilleController extends Controller
{
    /**
     * 📋 Afficher la liste des familles.
     */
    public function index()
    {
        $familles = FamilleProfile::with('user')->latest()->paginate(10);
        return view('admin.familles.index', compact('familles'));
    }

    /**
     * 👨‍👩‍👧 Afficher un profil famille.
     */
    public function show($id)
    {
        $famille = FamilleProfile::with('user')->findOrFail($id);
        return view('admin.familles.show', compact('famille'));
    }

    /**
     * ✏️ Formulaire d’édition d’un profil famille.
     */
    public function edit($id)
    {
        $famille = FamilleProfile::with('user')->findOrFail($id);
        return view('admin.familles.edit', compact('famille'));
    }

    /**
     * 💾 Mise à jour du profil famille.
     */
    public function update(Request $request, $id)
    {
        $famille = FamilleProfile::findOrFail($id);

        $validated = $request->validate([
            'adresse'        => 'nullable|string|max:255',
            'ville'          => 'nullable|string|max:255',
            'departement'    => 'nullable|string|max:255',
            'arrondissement' => 'nullable|string|max:255',
            'telephone'      => 'nullable|string|max:50',
            'nombre_enfants' => 'nullable|integer|min:0',
            'enfants'        => 'nullable|string|max:255',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 📸 Gestion de la photo
        if ($request->hasFile('photo')) {
            // Suppression ancienne photo
            if ($famille->photo && Storage::disk('public')->exists($famille->photo)) {
                Storage::disk('public')->delete($famille->photo);
            }
            // Nouvelle sauvegarde
            $validated['photo'] = $request->file('photo')->store('familles/photos', 'public');
        }

        $famille->update($validated);

        return redirect()
            ->route('admin.familles.show', $famille->id)
            ->with('success', 'Profil famille mis à jour avec succès ✅');
    }

    /**
     * 🗑️ Supprimer un profil famille.
     */
    public function destroy($id)
    {
        $famille = FamilleProfile::findOrFail($id);

        // Suppression de la photo associée
        if ($famille->photo && Storage::disk('public')->exists($famille->photo)) {
            Storage::disk('public')->delete($famille->photo);
        }

        $famille->delete();

        return back()->with('success', 'Profil famille supprimé avec succès ❌');
    }
}
