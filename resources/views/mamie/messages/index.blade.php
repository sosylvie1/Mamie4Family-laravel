@extends('layouts.mamie')

@section('title', 'Mes messages - Mamie | Mamie4Family')
@section('description', "Espace Mamie : messages reçus et envoyés.")

@section('mamie-content')
{{-- ✅ Message de succès --}}
@if (session('success'))
    <div role="alert"
         aria-live="polite"
         class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-4 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-green-400">
        <p class="font-semibold">✅ {{ session('success') }}</p>
    </div>
@endif

<main role="main" aria-labelledby="page-title" class="space-y-8 px-4 sm:px-6 lg:px-8">

    <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-4 flex items-center gap-2">
        💌 Mes messages
    </h1>

    {{-- 📥 MESSAGES REÇUS --}}
    <section role="region" aria-labelledby="recus-title" class="bg-white rounded-xl shadow border border-caramel-pastel p-4">
        <h2 id="recus-title" class="text-2xl font-semibold text-marron-fonce mb-3 flex items-center gap-2">
            📥 Messages reçus
        </h2>

        @if($messagesRecus->isEmpty())
            <p class="text-gray-500">Aucun message reçu.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-gray-800 border-collapse">
                    <thead class="bg-caramel text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">De</th>
                            <th class="px-4 py-2 text-left">Extrait</th>
                            <th class="px-4 py-2 text-center">Date</th>
                            <th class="px-4 py-2 text-center">Statut</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messagesRecus as $message)
                            <tr class="border-b hover:bg-caramel-pastel/30 transition">
                                <td class="px-4 py-2">{{ $message->sender->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ Str::limit($message->content, 60) }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if($message->is_read)
                                        <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded text-xs">✔ Lu</span>
                                    @else
                                        <span class="inline-block bg-red-100 text-red-700 px-2 py-1 rounded text-xs">● Non lu</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('mamie.messages.show', $message->id) }}"
                                       class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700">
                                        👁 Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination reçus --}}
            <div class="mt-3 text-center">
                {{ $messagesRecus->links() }}
            </div>
        @endif
    </section>

    {{-- 📤 MESSAGES ENVOYÉS --}}
    <section role="region" aria-labelledby="envoyes-title" class="bg-white rounded-xl shadow border border-caramel-pastel p-4">
        <h2 id="envoyes-title" class="text-2xl font-semibold text-marron-fonce mb-3 flex items-center gap-2">
            📤 Messages envoyés
        </h2>

        @if($messagesEnvoyes->isEmpty())
            <p class="text-gray-500">Aucun message envoyé.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-gray-800 border-collapse">
                    <thead class="bg-caramel text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">À</th>
                            <th class="px-4 py-2 text-left">Extrait</th>
                            <th class="px-4 py-2 text-center">Date</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messagesEnvoyes as $message)
                            <tr class="border-b hover:bg-caramel-pastel/30 transition">
                                <td class="px-4 py-2">{{ $message->receiver->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ Str::limit($message->content, 60) }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('mamie.messages.show', $message->id) }}"
                                       class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700">
                                        👁 Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination envoyés --}}
            <div class="mt-3 text-center">
                {{ $messagesEnvoyes->links() }}
            </div>
        @endif
    </section>
</main>
@endsection
