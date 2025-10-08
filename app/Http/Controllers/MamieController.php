<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MamieController extends Controller
{
    /**
     * 📋 Liste publique des mamies avec recherche
     */
    public function index(Request $request)
    {
        // On récupère les utilisateurs ayant le rôle "mamie" avec leur profil
        $query = User::where('role', 'mamie')->with('mamieProfile');

        // 🔍 Filtrage si recherche
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->whereHas('mamieProfile', function ($sub) use ($q) {
                $sub->where('ville', 'like', "%{$q}%")
                    ->orWhere('services', 'like', "%{$q}%")
                    ->orWhere('bio', 'like', "%{$q}%");
            });
        }

        $mamies = $query->paginate(9);

        return view('mamies.index', compact('mamies'));
    }

    /**
     * 👵 Affiche le profil public d’une mamie
     */
    public function show($id)
    {
        $mamie = \App\Models\MamieProfile::with('user')->findOrFail($id);
        return view('mamies.show', compact('mamie'));
    }
}
