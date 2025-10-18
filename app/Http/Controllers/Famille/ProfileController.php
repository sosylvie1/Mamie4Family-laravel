<?php

namespace App\Http\Controllers\Famille;

use App\Http\Controllers\Controller;
use App\Models\FamilleProfile;
use App\Models\Enfant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 👨‍👩‍👧 Afficher le profil de la famille connectée
     */
    public function show()
    {
        $familleProfile = Auth::user()->familleProfile;

        if (!$familleProfile) {
            return redirect()->route('famille.profile.edit')
                ->with('error', 'Profil introuvable.');
        }

        $familleProfile->load(['user', 'enfants']);

        return view('famille.profile.show', compact('familleProfile'));
    }

    /**
     * ✏️ Formulaire d’édition du profil famille
     */
    public function edit()
    {
        $profile = Auth::user()->familleProfile ?? new FamilleProfile(['user_id' => Auth::id()]);
        $profile->load('enfants');

        return view('famille.profile.edit', compact('profile'));
    }

    /**
     * 💾 Mise à jour ou création du profil famille
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'adresse'        => 'nullable|string|max:255',
            'ville'          => 'nullable|string|max:255',
            'code_postal'    => 'nullable|string|max:10',
            'departement'    => 'nullable|string|max:100',
            'arrondissement' => 'nullable|string|max:100',
            'telephone'      => 'nullable|string|max:20',
            'photo'          => 'nullable|image|max:2048',
        ]);

        // 🔎 Récupère ou crée le profil
        $profile = $user->familleProfile ?? new FamilleProfile(['user_id' => $user->id]);

        // 🖼️ Gestion photo
        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $profile->photo = $request->file('photo')->store('familles/photos', 'public');
        }

        // 💾 Mise à jour des champs
        $profile->fill($validated)->save();

        return redirect()->route('famille.profile.show')
            ->with('success', 'Profil famille mis à jour avec succès ✅');
    }

    /**
     * ➕ Ajouter un enfant
     */
    public function storeEnfant(Request $request)
    {
        $user = Auth::user();
        $profile = $user->familleProfile;

        if (!$profile) {
            return back()->with('error', 'Profil famille introuvable.');
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'age' => 'nullable|integer|min:0|max:18',
        ]);

        $profile->enfants()->create($validated);

        return back()->with('success', 'Nouvel enfant ajouté avec succès 👶');
    }

    /**
     * 🗑 Supprimer un enfant
     */
    public function deleteEnfant($id)
    {
        $user = Auth::user();
        $enfant = Enfant::findOrFail($id);

        if ($enfant->famille_profile_id !== $user->familleProfile->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer cet enfant.');
        }

        $enfant->delete();

        return back()->with('success', 'Enfant supprimé avec succès 🗑');
    }
}
