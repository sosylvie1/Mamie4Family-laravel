<?php

namespace App\Http\Controllers\Mamie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MamieProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * 👵 Afficher le profil de la mamie connectée
     */
    public function show()
{
    $mamie = Auth::user();
    $profile = $mamie->mamieProfile;

    $canSeePhone = false;

    // ✅ Si admin ou la mamie elle-même
    if (Auth::user()->role === 'admin' || Auth::id() === $mamie->id) {
        $canSeePhone = true;
    }

    // ✅ Si une famille connectée a déjà échangé un message avec la mamie
    if (Auth::check() && Auth::user()->role === 'famille') {
        $hasConversation = Message::where(function ($q) use ($mamie) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $mamie->id);
            })
            ->orWhere(function ($q) use ($mamie) {
                $q->where('sender_id', $mamie->id)
                  ->where('receiver_id', Auth::id());
            })
            ->exists();

        if ($hasConversation) {
            $canSeePhone = true;
        }
    }

    return view('mamie.profile.show', compact('mamie', 'profile', 'canSeePhone'));
}

    /**
     * ✏️ Formulaire d’édition du profil
     */
    public function edit()
    {
        $mamie = auth()->user();
        $profile = $mamie->mamieProfile ?? new MamieProfile();

        return view('mamie.profile.edit', compact('mamie', 'profile'));
    }

    /**
     * 💾 Mise à jour du profil
     */
    public function update(Request $request)
    {
        $mamie = auth()->user();

        $validated = $request->validate([
            'ville'        => 'nullable|string|max:255',
            'adresse'      => 'nullable|string|max:255',
            'departement'  => 'nullable|string|max:255',
            'arrondissement'=> 'nullable|string|max:255',
            'services'     => 'nullable|string|max:500',
            'tarif'        => 'nullable|numeric|min:0',
            'bio'          => 'nullable|string|max:1000',
            'photo'        => 'nullable|image|max:2048',
            'cni'          => 'nullable|file|mimes:jpeg,png,pdf|max:4096',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Création ou récupération du profil
        $profile = $mamie->mamieProfile ?? new MamieProfile(['user_id' => $mamie->id]);

        // 📷 Upload photo (public)
        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $profile->photo = $request->file('photo')->store('mamies/photos', 'public');
        }

        // 🪪 Upload pièce d’identité (privée)
        if ($request->hasFile('cni')) {
            if ($profile->cni && Storage::disk('private')->exists($profile->cni)) {
                Storage::disk('private')->delete($profile->cni);
            }
            $profile->cni = $request->file('cni')->store('mamies/cni', 'private');
        }

        // 💾 Mise à jour des champs
        $profile->fill([
            'ville'         => $validated['ville'] ?? null,
            'adresse'       => $validated['adresse'] ?? null,
            'departement'   => $validated['departement'] ?? null,
            'arrondissement'=> $validated['arrondissement'] ?? null,
            'services'      => $validated['services'] ?? null,
            'tarif'         => $validated['tarif'] ?? null,
            'bio'           => $validated['bio'] ?? null,
            'telephone' => $request->telephone,
        ]);

        $profile->save();

        return redirect()->route('mamie.profile.show')
            ->with('success', 'Profil mamie mis à jour avec succès ✅');
    }

    /**
     * 📎 Télécharger la CNI de la mamie connectée
     */
    public function downloadCni()
    {
        $mamie = auth()->user()->mamieProfile;

        if (!$mamie || !$mamie->cni || !Storage::disk('private')->exists($mamie->cni)) {
            return back()->with('error', 'Aucune CNI disponible.');
        }

        return Storage::disk('private')->download(
            $mamie->cni,
            'Ma_CNI_' . auth()->user()->name . '.' . pathinfo($mamie->cni, PATHINFO_EXTENSION)
        );
    }
}
