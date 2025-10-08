<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
        
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Réponse personnalisée après login (redirige selon le rôle)
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Rate limiters obligatoires (login / 2FA)
        |--------------------------------------------------------------------------
        */
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return [
                Limit::perMinute(5)->by($email . $request->ip()),
            ];
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


Fortify::redirects('register', function (Request $request) {
    $user = Auth::user();
    if ($user->role === 'famille') {
        return '/famille/dashboard';
    }
    if ($user->role === 'mamie') {
        return '/mamie/dashboard';
    }
    if ($user->role === 'admin') {
        return '/admin/dashboard';
    }
    return '/';
});


        /*
        |--------------------------------------------------------------------------
        | Actions Fortify
        |--------------------------------------------------------------------------
        */
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        /*
        |--------------------------------------------------------------------------
        | Vues personnalisées
        |--------------------------------------------------------------------------
        */
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn ($request) => view('auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));

        /*
        |--------------------------------------------------------------------------
        | Authentification personnalisée
        | -> Vérifie uniquement email + mot de passe
        | -> Le rôle sera utilisé uniquement pour la redirection après login
        |--------------------------------------------------------------------------
        */
        Fortify::authenticateUsing(function ($request) {
            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        /*
        |--------------------------------------------------------------------------
        | Redirection après login
        | -> Gérée par app/Http/Responses/LoginResponse.php
        |--------------------------------------------------------------------------
        */
    }
}
