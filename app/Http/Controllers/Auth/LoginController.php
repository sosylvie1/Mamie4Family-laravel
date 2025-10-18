<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm(Request $request)
    {
        $role = $request->query('role'); // exemple : mamie, famille, admin
        return view('auth.login', compact('role'));
    }

    /**
     * Traite la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $role = $request->input('role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Vérifie que le rôle correspond (si on a cliqué sur un espace spécifique)
            if ($role && $user->role !== $role) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Ce compte n’appartient pas à cette catégorie.',
                ])->withInput();
            }

            // Redirection selon le rôle
            return match ($user->role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'famille' => redirect()->route('famille.dashboard'),
                'mamie'   => redirect()->route('mamie.dashboard'),
                default   => redirect()->route('welcome'),
            };
        }

        return back()->withErrors(['email' => 'Identifiants invalides.'])->withInput();
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
