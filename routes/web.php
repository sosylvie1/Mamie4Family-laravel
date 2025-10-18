<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

// =====================
// Contrôleurs Admin
// =====================
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MamieController as AdminMamieController;
use App\Http\Controllers\Admin\FamilleController as AdminFamilleController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AdminProfileController;

// =====================
// Contrôleurs Famille
// =====================
use App\Http\Controllers\Famille\DashboardController as FamilleDashboardController;
use App\Http\Controllers\Famille\MessageController as FamilleMessageController;
use App\Http\Controllers\Famille\ProfileController as FamilleProfileController;
use App\Http\Controllers\Famille\MamieController as FamilleMamieController;

// =====================
// Contrôleurs Mamie
// =====================
use App\Http\Controllers\Mamie\DashboardController as MamieDashboardController;
use App\Http\Controllers\Mamie\MessageController as MamieMessageController;
use App\Http\Controllers\Mamie\ProfileController as MamieProfileController;
use App\Http\Controllers\Mamie\FamilleController as MamieFamilleController;

// =====================
// Contrôleurs Publics
// =====================
use App\Http\Controllers\MamieController as PublicMamieController;


/*
|--------------------------------------------------------------------------
| 🔐 Connexion / Déconnexion
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 🔁 Réinitialisation du mot de passe
|--------------------------------------------------------------------------
*/
Route::get('/mot-de-passe-oublie', [ForgotPasswordController::class, 'showForm'])
    ->name('password.request');

Route::post('/mot-de-passe-oublie', [ForgotPasswordController::class, 'sendLink'])
    ->name('password.email');


/*
|--------------------------------------------------------------------------
| ⚖️ Pages légales
|--------------------------------------------------------------------------
*/
Route::view('/cgu', 'legal.cgu')->name('cgu');
Route::view('/confidentialite', 'legal.confidentialite')->name('confidentialite');
Route::view('/plan-du-site', 'legal.plan')->name('plan-du-site');


/*
|--------------------------------------------------------------------------
| 🌍 Routes publiques (visiteurs)
|--------------------------------------------------------------------------
*/

// 🏠 Accueil
Route::get('/', fn() => view('welcome'))->name('welcome');

// 📬 Contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 👵 Catalogue des Mamies publiques
Route::get('/mamies', [PublicMamieController::class, 'index'])->name('mamies.index');
Route::get('/mamies/{id}', [PublicMamieController::class, 'show'])->name('mamies.show');


/*
|--------------------------------------------------------------------------
| 🧾 Inscription (visiteurs uniquement)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'choose'])->name('register');
    Route::get('/register/choice', [RegisteredUserController::class, 'choose'])->name('register.choice');

    // 👨‍👩‍👧 Famille
    Route::get('/register/famille', [RegisteredUserController::class, 'createFamille'])->name('familles.register');
    Route::post('/register/famille', [RegisteredUserController::class, 'storeFamille'])->name('familles.register.store');

    // 👵 Mamie
    Route::get('/register/mamie', [RegisteredUserController::class, 'createMamie'])->name('mamies.register');
    Route::post('/register/mamie', [RegisteredUserController::class, 'storeMamie'])->name('mamies.register.store');
});


/*
|--------------------------------------------------------------------------
| 🛠️ Routes Admin (role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Tableau de bord
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Téléchargement sécurisé CNI
        Route::get('/mamies/{id}/cni', [AdminMamieController::class, 'downloadCni'])
            ->name('mamies.cni.download');

        // Gestion des entités
        Route::resource('users', AdminUserController::class);
        Route::resource('mamies', AdminMamieController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('familles', AdminFamilleController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('messages', AdminMessageController::class)->only(['index', 'show', 'create', 'store', 'destroy']);

        // Profil Admin
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
    });


/*
|--------------------------------------------------------------------------
| 👨‍👩‍👧 Routes Famille (role:famille)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:famille'])
    ->prefix('famille')
    ->name('famille.')
    ->group(function () {

        // Tableau de bord
        Route::get('/dashboard', [FamilleDashboardController::class, 'index'])->name('dashboard');

        // Messagerie
        Route::get('/messages', [FamilleMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [FamilleMessageController::class, 'create'])->name('messages.create');
        Route::post('/messages', [FamilleMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{id}', [FamilleMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/reply', [FamilleMessageController::class, 'reply'])->name('messages.reply');

        // Profil
        Route::get('/profile', [FamilleProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [FamilleProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [FamilleProfileController::class, 'update'])->name('profile.update');

        // Gestion des enfants
        Route::post('/enfant', [FamilleProfileController::class, 'storeEnfant'])->name('enfant.store');
        Route::delete('/enfant/{id}', [FamilleProfileController::class, 'deleteEnfant'])->name('enfant.delete');

        // Annuaire Mamies
        Route::get('/mamies', [FamilleMamieController::class, 'index'])->name('mamies.index');
        Route::get('/mamies/{id}', [FamilleMamieController::class, 'show'])->name('mamies.show');
    });


/*
|--------------------------------------------------------------------------
| 👵 Routes Mamie (role:mamie)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mamie'])
    ->prefix('mamie')
    ->name('mamie.')
    ->group(function () {
        // CNI personnelle
        Route::get('/profile/cni', [MamieProfileController::class, 'downloadCni'])
            ->name('profile.cni.download');

        // Tableau de bord
        Route::get('/dashboard', [MamieDashboardController::class, 'index'])->name('dashboard');

        // Profil
        Route::get('/profile', [MamieProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [MamieProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [MamieProfileController::class, 'update'])->name('profile.update');

        // Messagerie
        Route::get('/messages', [MamieMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [MamieMessageController::class, 'create'])->name('messages.create');
        Route::post('/messages', [MamieMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{id}', [MamieMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/reply', [MamieMessageController::class, 'reply'])->name('messages.reply');

        // Annuaire Familles
        Route::get('/familles', [MamieFamilleController::class, 'index'])->name('familles.index');
        Route::get('/familles/{id}', [MamieFamilleController::class, 'show'])->name('familles.show');
    });


/*
|--------------------------------------------------------------------------
| 🔁 Redirection automatique selon le rôle
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', function () {
        $user = auth()->user();

        return match (true) {
            $user->isAdmin()   => redirect()->route('admin.dashboard'),
            $user->isFamille() => redirect()->route('famille.dashboard'),
            $user->isMamie()   => redirect()->route('mamie.dashboard'),
            default             => redirect()->route('welcome'),
        };
    })->name('dashboard');
