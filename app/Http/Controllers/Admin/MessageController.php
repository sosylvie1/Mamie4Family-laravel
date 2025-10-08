<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Liste des messages
     */
    public function index()
    {
        $this->authorizeAdmin();

        $messages = Message::with(['sender', 'receiver'])
            ->latest()
            ->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Afficher un message
     */
    public function show($id)
    {
        $this->authorizeAdmin();

        $message = Message::with(['sender', 'receiver'])->findOrFail($id);

        // ⚡ Marquer comme lu si pas déjà lu
        $message->markAsRead();

        return view('admin.messages.show', compact('message'));
    }

    public function store(Request $request)
{
    $this->authorizeAdmin();

    $validated = $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'content'     => 'required|string|min:3',
    ]);

    Message::create([
        'sender_id'   => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'content'     => $validated['content'],
        'is_read'     => 0,
    ]);

    return redirect()->route('admin.messages.index')
        ->with('success', '✅ Réponse envoyée avec succès !');
}

    /**
     * Supprimer un message
     */
    public function destroy($id)
    {
        $this->authorizeAdmin();

        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Le message a bien été supprimé ✅');
    }

    /**
     * Vérification que seul un admin accède
     */
    private function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Accès réservé à l’admin');
        }
    }
}
