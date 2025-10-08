<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Redirection après déconnexion
     */
    public function toResponse($request)
    {
        // Si l'utilisateur est encore disponible dans la requête
        if ($request->user() && $request->user()->role === 'admin') {
            return redirect('/admin/login')
                ->with('success', 'Déconnexion réussie. Merci et à bientôt Admin 👋');
        }

        // Pour famille & mamie → accueil
        return redirect()->route('welcome')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
