<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// =====================
// Contrôleurs Admin
// =====================
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MamieController as AdminMamieController;
use App\Http\Controllers\Admin\FamilleController as AdminFamilleController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

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

// =====================
// Auth (Inscription)
// =====================
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Routes publiques (invités)
|--------------------------------------------------------------------------
*/

// 🏠 Page d’accueil
Route::get('/', fn() => view('welcome'))->name('welcome');

// 📬 Page contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 👵 Catalogue public des Mamies
Route::get('/mamies', [PublicMamieController::class, 'index'])->name('mamies.index');
Route::get('/mamies/{id}', [PublicMamieController::class, 'show'])->name('mamies.show');

/*
|--------------------------------------------------------------------------
| Inscription (visiteurs uniquement)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // 🧾 Choix du type d’inscription
    Route::get('/register', [RegisteredUserController::class, 'choose'])->name('register');
    Route::get('/register/choice', [RegisteredUserController::class, 'choose'])->name('register.choice');

    // 👨‍👩‍👧 Inscription Famille
    Route::get('/register/famille', [RegisteredUserController::class, 'createFamille'])->name('familles.register');
    Route::post('/register/famille', [RegisteredUserController::class, 'storeFamille'])->name('familles.register.store');

    // 👵 Inscription Mamie
    Route::get('/register/mamie', [RegisteredUserController::class, 'createMamie'])->name('mamies.register');
    Route::post('/register/mamie', [RegisteredUserController::class, 'storeMamie'])->name('mamies.register.store');
});

/*
|--------------------------------------------------------------------------
| Routes Admin (role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 📊 Tableau de bord
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // 📎 Téléchargement sécurisé de la CNI
        Route::get('/mamies/{id}/cni', [AdminMamieController::class, 'downloadCni'])
            ->name('mamies.cni.download');

        // 👥 Gestion des utilisateurs et profils
        Route::resource('users', AdminUserController::class);
        Route::resource('mamies', AdminMamieController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('familles', AdminFamilleController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('messages', AdminMessageController::class)->only(['index', 'show', 'create', 'store', 'destroy']);

        // 👤 Profil Admin
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });

/*
|--------------------------------------------------------------------------
| Routes Famille (role:famille)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:famille'])
    ->prefix('famille')
    ->name('famille.')
    ->group(function () {
        // 📊 Tableau de bord
        Route::get('/dashboard', [FamilleDashboardController::class, 'index'])->name('dashboard');

        // 📩 Messagerie Famille
        Route::get('/messages', [FamilleMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [FamilleMessageController::class, 'create'])->name('messages.create');
        Route::post('/messages', [FamilleMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{id}', [FamilleMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/reply', [FamilleMessageController::class, 'reply'])->name('messages.reply');

        // 👤 Profil Famille
        Route::get('/profile', [FamilleProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [FamilleProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [FamilleProfileController::class, 'update'])->name('profile.update');

        // 👵 Annuaire des Mamies
        // Route::get('/mamies/contactees', [FamilleMamieController::class, 'contactees'])->name('mamies.contactees');

        Route::get('/mamies', [FamilleMamieController::class, 'index'])->name('mamies.index');
        Route::get('/mamies/{id}', [FamilleMamieController::class, 'show'])->name('mamies.show');
    });

/*
|--------------------------------------------------------------------------
| Routes Mamie (role:mamie)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mamie'])
    ->prefix('mamie')
    ->name('mamie.')
    ->group(function () {
        // 👵 Téléchargement personnel de la CNI
        Route::get('/profile/cni', [MamieProfileController::class, 'downloadCni'])
            ->name('profile.cni.download');

        // 📊 Tableau de bord
        Route::get('/dashboard', [MamieDashboardController::class, 'index'])->name('dashboard');

        // 👤 Profil Mamie
        Route::get('/profile', [MamieProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [MamieProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [MamieProfileController::class, 'update'])->name('profile.update');

        // 📩 Messagerie Mamie
        Route::get('/messages', [MamieMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [MamieMessageController::class, 'create'])->name('messages.create');
        Route::post('/messages', [MamieMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{id}', [MamieMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/reply', [MamieMessageController::class, 'reply'])->name('messages.reply');

        // 👨‍👩‍👧 Annuaire des Familles
        Route::get('/familles', [MamieFamilleController::class, 'index'])->name('familles.index');
        Route::get('/familles/{id}', [MamieFamilleController::class, 'show'])->name('familles.show');
    });

/*
|--------------------------------------------------------------------------
| Routes génériques Jetstream
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match (true) {
            $user->isAdmin() => redirect()->route('admin.dashboard'),
            $user->isFamille() => redirect()->route('famille.dashboard'),
            $user->isMamie() => redirect()->route('mamie.dashboard'),
            default => redirect()->route('welcome'),
        };
    })->name('dashboard');
});
