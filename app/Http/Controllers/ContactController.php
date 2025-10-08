<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Afficher le formulaire de contact public
     */
    public function showForm()
    {
        return view('contact');
    }

    /**
     * Traiter l’envoi et enregistrer en base
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:5',
        ]);

        // 👤 Définir le destinataire (ici l'admin avec ID = 1 par défaut)
        $receiverId = 1;

        // Enregistrement en BDD
        Message::create([
            'sender_id'   => auth()->id() ?? null, // si l’expéditeur est connecté
            'receiver_id' => $receiverId,
            'content'     => "De : {$validated['name']} ({$validated['email']})\n\n{$validated['message']}",
            'is_read'     => 0,
        ]);

        return redirect()->route('contact')->with('success', '✅ Votre message a bien été envoyé !');
    }
}
