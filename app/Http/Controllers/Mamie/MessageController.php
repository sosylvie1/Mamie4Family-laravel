<?php

namespace App\Http\Controllers\Mamie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * 📩 Liste des messages reçus et envoyés
     */
    public function index()
    {
        $user = Auth::user();

        $messagesRecus = Message::with(['sender', 'receiver'])
            ->where('receiver_id', $user->id)
            ->latest()
            ->paginate(5, ['*'], 'recus');

        $messagesEnvoyes = Message::with(['sender', 'receiver'])
            ->where('sender_id', $user->id)
            ->latest()
            ->paginate(5, ['*'], 'envoyes');

        return view('mamie.messages.index', compact('messagesRecus', 'messagesEnvoyes'));
    }

    /**
     * 👁 Voir un message
     */
    public function show($id)
    {
        $user = Auth::user();

        $message = Message::with(['sender', 'receiver'])
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->findOrFail($id);

        // ✅ Marquer comme lu
        if ($message->receiver_id === $user->id && !$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('mamie.messages.show', compact('message'));
    }

    /**
     * 📝 Écrire un nouveau message
     */
    public function create()
    {
        $familles = User::where('role', 'famille')->get();
        $admins   = User::where('role', 'admin')->get();

        return view('mamie.messages.create', compact('familles', 'admins'));
    }

    /**
     * 💾 Envoyer un message Mamie → Famille / Admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content'     => $request->content,
        ]);

        return redirect()->route('mamie.messages.index')
            ->with('success', 'Message envoyé avec succès ✅');
    }

    /**
     * 📤 Répondre à un message reçu (Mamie → Famille ou Admin)
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        $original = Message::findOrFail($id);

        // 🧭 On répond à l’expéditeur d’origine
        Message::create([
            'sender_id'   => $user->id,            // Mamie = expéditrice
            'receiver_id' => $original->sender_id, // Famille ou Admin = destinataire
            'content'     => $request->content,
        ]);

        return redirect()->route('mamie.messages.index')
            ->with('success', 'Réponse envoyée avec succès ✅');
    }
}
