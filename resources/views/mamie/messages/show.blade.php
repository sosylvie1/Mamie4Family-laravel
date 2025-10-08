@extends('layouts.mamie')

@section('title', 'Lecture du message - Mamie | Mamie4Family')
@section('description', "Consultation et réponse à un message dans l’espace Mamie.")

@section('mamie-content')
<main role="main" aria-labelledby="page-title">
    {{-- ✅ Message de succès --}}
@if (session('success'))
    <div role="alert"
         aria-live="polite"
         class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-4 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-green-400">
        <p class="font-semibold">✅ {{ session('success') }}</p>
    </div>
@endif

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
        <form action="{{ route('mamie.messages.store') }}" method="POST" class="space-y-4 max-w-lg">
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

    <a href="{{ route('mamie.messages.index') }}"
       class="inline-block mt-6 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       ⬅ Retour
    </a>
</main>
@endsection
