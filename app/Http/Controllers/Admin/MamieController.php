<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MamieProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MamieController extends Controller
{
    /**
     * 📋 Liste des mamies (avec pagination)
     */
    public function index()
    {
        $mamies = MamieProfile::with('user')->latest()->paginate(10);
        return view('admin.mamies.index', compact('mamies'));
    }

    /**
     * 👵 Affiche le profil complet d'une mamie
     */
    public function show($id)
    {
        $mamie = MamieProfile::with('user')->findOrFail($id);
        return view('admin.mamies.show', compact('mamie'));
    }

    /**
     * ✏️ Formulaire d’édition du profil mamie
     */
    public function edit($id)
    {
        $mamie = MamieProfile::with('user')->findOrFail($id);
        return view('admin.mamies.edit', compact('mamie'));
    }

    /**
     * 💾 Mise à jour du profil mamie
     */
    public function update(Request $request, $id)
    {
        $mamie = MamieProfile::findOrFail($id);

        $validated = $request->validate([
            'bio'          => 'nullable|string|max:1000',
            'adresse'      => 'nullable|string|max:255',
            'ville'        => 'nullable|string|max:255',
            'departement'  => 'nullable|string|max:255',
            'arrondissement' => 'nullable|string|max:255',
            'services'     => 'nullable|string|max:255',
            'tarif'        => 'nullable|numeric|min:0',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cni'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        // 📷 Upload photo (stockée publiquement)
        if ($request->hasFile('photo')) {
            if ($mamie->photo && Storage::disk('public')->exists($mamie->photo)) {
                Storage::disk('public')->delete($mamie->photo);
            }
            $validated['photo'] = $request->file('photo')->store('mamies/photos', 'public');
        }

        // 🪪 Upload CNI (stockée dans storage privé)
        if ($request->hasFile('cni')) {
            if ($mamie->cni && Storage::disk('private')->exists($mamie->cni)) {
                Storage::disk('private')->delete($mamie->cni);
            }
            $validated['cni'] = $request->file('cni')->store('mamies/cni', 'private');
        }

        // 💾 Mise à jour du profil
        $mamie->update($validated);

        return redirect()
            ->route('admin.mamies.show', $mamie->id)
            ->with('success', 'Profil mamie mis à jour avec succès ✅');
    }

    /**
     * 📎 Téléchargement de la CNI (stockée en privé)
     */
    public function downloadCni($id)
    {
        $mamie = MamieProfile::with('user')->findOrFail($id);

        if (!$mamie->cni || !Storage::disk('private')->exists($mamie->cni)) {
            return back()->with('error', 'Aucune CNI disponible pour cette mamie.');
        }

        return Storage::disk('private')->download(
            $mamie->cni,
            'CNI_' . $mamie->user->name . '.' . pathinfo($mamie->cni, PATHINFO_EXTENSION)
        );
    }

    /**
     * 🗑️ Suppression d’un profil mamie
     */
    public function destroy($id)
    {
        $mamie = MamieProfile::findOrFail($id);

        // Suppression fichiers liés
        if ($mamie->photo && Storage::disk('public')->exists($mamie->photo)) {
            Storage::disk('public')->delete($mamie->photo);
        }

        if ($mamie->cni && Storage::disk('private')->exists($mamie->cni)) {
            Storage::disk('private')->delete($mamie->cni);
        }

        $mamie->delete();

        return back()->with('success', 'Profil mamie supprimé avec succès ❌');
    }
}
