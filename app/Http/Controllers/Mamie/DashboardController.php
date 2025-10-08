<?php

namespace App\Http\Controllers\Mamie;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * 🏠 Tableau de bord Mamie
     */
    public function index()
    {
        $mamie = Auth::user();

        // ✅ Compte des messages reçus / envoyés
        $messagesRecus   = Message::where('receiver_id', $mamie->id)->count();
        $messagesEnvoyes = Message::where('sender_id', $mamie->id)->count();
        $messagesCount   = $messagesRecus + $messagesEnvoyes;

        // ✅ Familles qui ont contacté la mamie (distincts)
        $famillesContact = User::where('role', 'famille')
            ->whereIn('id', function ($q) use ($mamie) {
                $q->select('sender_id')
                    ->from('messages')
                    ->where('receiver_id', $mamie->id);
            })
            ->distinct()
            ->count();

        // ✅ Message d’accueil
        $welcomeMessage = "Bienvenue, {$mamie->name} 🌷 Vous êtes connectée à votre espace Mamie.";

        return view('mamie.dashboard', compact(
            'mamie',
            'messagesCount',
            'messagesRecus',
            'messagesEnvoyes',
            'famillesContact',
            'welcomeMessage'
        ));
    }
}
