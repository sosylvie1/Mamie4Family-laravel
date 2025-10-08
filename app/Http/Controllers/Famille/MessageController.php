<?php

namespace App\Http\Controllers\Famille;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * 📬 Liste séparée : messages reçus et envoyés
     */
    public function index()
    {
        $famille = Auth::user();

        if (!$famille || !$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        // ✅ Récupérer les messages reçus
        $messagesRecus = $famille->receivedMessages()
            ->with(['sender'])
            ->latest()
            ->get();

        // ✅ Récupérer les messages envoyés
        $messagesEnvoyes = $famille->sentMessages()
            ->with(['receiver'])
            ->latest()
            ->get();

        // ✅ Envoyer les deux à la vue
        return view('famille.messages.index', compact('messagesRecus', 'messagesEnvoyes'));
    }

    /**
     * 👁 Voir un message en détail
     */
    public function show($id)
    {
        $famille = Auth::user();

        $message = Message::with(['sender', 'receiver'])
            ->where(function ($q) use ($famille) {
                $q->where('sender_id', $famille->id)
                  ->orWhere('receiver_id', $famille->id);
            })
            ->findOrFail($id);

        // ✅ Marquer comme lu uniquement si la famille est le destinataire
        if (!$message->is_read && $message->receiver_id === $famille->id) {
            $message->update(['is_read' => true]);
        }

        return view('famille.messages.show', compact('message'));
    }

    /**
     * 📝 Formulaire pour écrire un message
     */
    public function create()
    {
        $famille = Auth::user();

        if (!$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        // Une famille peut écrire à une Mamie ou à un Admin
        $mamies = User::where('role', 'mamie')->get();
        $admins = User::where('role', 'admin')->get();

        return view('famille.messages.create', compact('mamies', 'admins'));
    }

    /**
     * 💾 Enregistrer un nouveau message
     */
    public function store(Request $request)
    {
        $famille = Auth::user();

        if (!$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id'   => $famille->id,
            'receiver_id' => $request->receiver_id,
            'content'     => $request->content,
        ]);

        return redirect()->route('famille.messages.index')
            ->with('success', 'Message envoyé avec succès ✅');
    }

    /**
     * 💬 Répondre à un message existant
     */
    public function reply(Request $request, $id)
    {
        $famille = Auth::user();

        if (!$famille->isFamille()) {
            abort(403, 'Accès interdit.');
        }

        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $original = Message::findOrFail($id);

        Message::create([
            'sender_id'   => $famille->id,
            'receiver_id' => $original->sender_id,
            'content'     => $request->content,
        ]);

        return redirect()->route('famille.messages.index')
            ->with('success', 'Réponse envoyée avec succès ✅');
    }
}
