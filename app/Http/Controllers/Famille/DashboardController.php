<?php

namespace App\Http\Controllers\Famille;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * 🏠 Tableau de bord Famille
     */
    public function index()
    {
        $famille = Auth::user();

        if (!$famille || !$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        // ✅ Compte les messages envoyés et reçus
        $messagesEnvoyes = $famille->sentMessages()->count();
        $messagesRecus   = $famille->receivedMessages()->count();
        $messagesCount   = $messagesEnvoyes + $messagesRecus;

        // ✅ Derniers messages reçus
        $messages = $famille->receivedMessages()
            ->with('sender')
            ->latest()
            ->take(5)
            ->get();

        // ✅ Mamies contactées (via les messages envoyés)
        $mamiesContactees = User::where('role', 'mamie')
            ->whereIn('id', function ($q) use ($famille) {
                $q->select('receiver_id')
                  ->from('messages')
                  ->where('sender_id', $famille->id);
            })
            ->count();

        // ✅ Message de bienvenue
        $welcomeMessage = "Bienvenue, {$famille->name} 🎉 Vous êtes connecté(e) à votre espace Famille.";

        return view('famille.dashboard', compact(
            'famille',
            'messagesCount',
            'messagesEnvoyes',
            'messagesRecus',
            'messages',
            'mamiesContactees',
            'welcomeMessage'
        ));
    }
}
