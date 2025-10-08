<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Redirection après connexion
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // Redirection selon le rôle
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'famille':
                return redirect()->route('famille.messages.index');

            case 'mamie':
                return redirect()->route('mamie.dashboard');

            default:
                return redirect()->route('dashboard'); // fallback générique
        }
    }
}

