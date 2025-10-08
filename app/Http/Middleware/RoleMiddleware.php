<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie si l'utilisateur possède l'un des rôles autorisés
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Vous devez être connecté.');
        }

        // Vérifier si son rôle est dans la liste des rôles autorisés
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->route('home')->with('error', 'Accès refusé.');
        }

        return $next($request);
    }
}

