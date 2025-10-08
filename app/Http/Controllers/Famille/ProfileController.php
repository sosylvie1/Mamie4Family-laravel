<?php

namespace App\Http\Controllers\Famille;

use App\Http\Controllers\Controller;
use App\Models\FamilleProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 👨‍👩‍👧 Afficher le profil de la famille connectée
     */
    public function show()
    {
        $famille = auth()->user()->familleProfile;

        if (!$famille) {
            return redirect()->route('famille.profile.create')
                ->with('error', 'Profil introuvable.');
        }

        $famille->load('user');

        return view('famille.profile.show', compact('famille'));
    }

    /**
     * ✏️ Formulaire d’édition du profil famille
     */
    public function edit()
    {
        $profile = auth()->user()->familleProfile ?? new FamilleProfile(['user_id' => auth()->id()]);
        return view('famille.profile.edit', compact('profile'));
    }

    /**
     * 💾 Mise à jour du profil famille
     */
    public function update(Request $request)
    {
        $famille = auth()->user();

        $validated = $request->validate([
            'adresse'        => 'nullable|string|max:255',
            'ville'          => 'nullable|string|max:255',
            'departement'    => 'nullable|string|max:100',
            'arrondissement' => 'nullable|string|max:100',
            'telephone'      => 'nullable|string|max:20',
            'nombre_enfants' => 'nullable|integer|min:0',
            'enfants'        => 'nullable|string|max:255',
            'photo'          => 'nullable|image|max:2048',
        ]);

        $profile = $famille->familleProfile ?? new FamilleProfile(['user_id' => $famille->id]);

        // 📸 Upload photo
        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $profile->photo = $request->file('photo')->store('familles/photos', 'public');
        }

        // 💾 Mise à jour des champs
        $profile->fill([
            'adresse'        => $validated['adresse'] ?? null,
            'ville'          => $validated['ville'] ?? null,
            'departement'    => $validated['departement'] ?? null,
            'arrondissement' => $validated['arrondissement'] ?? null,
            'telephone'      => $validated['telephone'] ?? null,
            'nombre_enfants' => $validated['nombre_enfants'] ?? null,
            'enfants'        => $validated['enfants'] ?? null,
        ]);

        $profile->save();

        return redirect()->route('famille.profile.show')
            ->with('success', 'Profil famille mis à jour avec succès ✅');
    }
}
