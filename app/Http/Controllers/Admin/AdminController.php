<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;

class AdminController extends Controller
{
    public function dashboard()
    {
        // ✅ Statistiques principales
        $famillesCount = User::where('role', 'famille')->count();
        $mamiesCount   = User::where('role', 'mamie')->count();
        $usersCount    = User::count();
        $messagesCount = Message::count();

        // ✅ Derniers messages reçus/envoyés
        $latestMessages = Message::with(['sender', 'receiver'])
            ->latest()
            ->take(5)
            ->get();

        // ✅ Derniers utilisateurs inscrits
        $latestUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'famillesCount'  => $famillesCount,
            'mamiesCount'    => $mamiesCount,
            'usersCount'     => $usersCount,
            'messagesCount'  => $messagesCount,
            'latestMessages' => $latestMessages,
            'latestUsers'    => $latestUsers,
        ]);
    }
}
