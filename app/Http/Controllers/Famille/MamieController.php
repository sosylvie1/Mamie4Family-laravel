<?php

namespace App\Http\Controllers\Famille;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MamieController extends Controller
{
    /**
     * 👵 Liste des mamies contactées par la famille connectée
     * (seules les mamies ayant reçu un message de cette famille)
     */
    public function index(Request $request)
    {
        $famille = Auth::user();

        // 🔒 Vérifie que l'utilisateur est bien une famille
        if (!$famille || !$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        // 🔎 On récupère uniquement les mamies qui ont reçu un message de cette famille
        $query = User::where('role', 'mamie')
            ->whereIn('id', function ($subQuery) use ($famille) {
                $subQuery->select('receiver_id')
                    ->from('messages')
                    ->where('sender_id', $famille->id);
            })
            ->with('mamieProfile');

        // 🔍 Recherche facultative (ville, service, bio)
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->whereHas('mamieProfile', function ($sub) use ($q) {
                $sub->where('ville', 'like', "%{$q}%")
                    ->orWhere('services', 'like', "%{$q}%")
                    ->orWhere('bio', 'like', "%{$q}%");
            });
        }

        // ✅ Pagination
        $mamies = $query->paginate(9);

        // ✅ Affiche les mamies contactées dans la même vue que l’annuaire
        return view('famille.mamies.index', compact('mamies'));
    }

    /**
     * 👁 Voir le profil d'une mamie contactée
     */
    public function show($id)
    {
        $mamie = User::where('role', 'mamie')
            ->with('mamieProfile')
            ->findOrFail($id);

        return view('famille.mamies.show', compact('mamie'));
    }
}
