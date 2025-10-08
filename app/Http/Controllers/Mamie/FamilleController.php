<?php

namespace App\Http\Controllers\Mamie;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilleController extends Controller
{
    /**
     * 🧭 Liste des familles ayant contacté la mamie connectée
     * + possibilité de filtrer (ville, département, enfants)
     */
    public function index(Request $request)
    {
        $mamie = Auth::user();

        // 🔎 On récupère uniquement les familles qui ont envoyé un message à la mamie
        $query = User::where('role', 'famille')
            ->whereIn('id', function ($subQuery) use ($mamie) {
                $subQuery->select('sender_id')
                    ->from('messages')
                    ->where('receiver_id', $mamie->id);
            })
            ->with('familleProfile');

        // 🔍 Recherche (facultative)
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->whereHas('familleProfile', function ($sub) use ($q) {
                $sub->where('adresse', 'like', "%{$q}%")
                    ->orWhere('departement', 'like', "%{$q}%")
                    ->orWhere('ville', 'like', "%{$q}%")
                    ->orWhere('details_enfants', 'like', "%{$q}%");
            });
        }

        $familles = $query->paginate(9);

        return view('mamie.familles.index', compact('familles'));
    }

    /**
     * 👁️ Afficher le profil d’une famille précise
     */
    public function show($id)
    {
        $famille = User::where('role', 'famille')
            ->with('familleProfile')
            ->findOrFail($id);

        return view('mamie.familles.show', compact('famille'));
    }
}
