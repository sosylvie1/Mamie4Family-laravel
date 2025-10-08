@extends('layouts.admin')

@section('title', 'Lecture du message - Admin | Mamie4Family')
@section('description', "Consultation et réponse à un message dans l’espace Admin.")

@section('admin-content')
<main role="main" aria-labelledby="page-title">
    <h1 id="page-title" class="text-2xl font-bold mb-4">📨 Message</h1>

    {{-- Détails du message --}}
    <div class="bg-white shadow rounded p-4">
        <p><strong>De :</strong> {{ $message->sender->name ?? '—' }}</p>
        <p><strong>À :</strong> {{ $message->receiver->name ?? '—' }}</p>
        <p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
        <hr class="my-3">
        <p>{{ $message->content }}</p>
    </div>

    {{-- Formulaire de réponse --}}
    <div class="mt-6" id="reply-form">
        <h2 class="text-xl font-bold mb-3">✍️ Répondre</h2>
        <form action="{{ route('admin.messages.store') }}" method="POST" class="space-y-4 max-w-lg">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $message->sender->id }}">

            <div>
                <label for="content" class="block text-sm font-medium">Votre réponse</label>
                <textarea id="content" name="content" rows="4" required
                          class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                📤 Envoyer
            </button>
        </form>
    </div>

    <a href="{{ route('admin.messages.index') }}"
       class="inline-block mt-6 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       ⬅ Retour
    </a>
</main>
@endsection
