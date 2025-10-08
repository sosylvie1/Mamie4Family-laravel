@extends('layouts.famille')

@section('title', 'Mes messages - Famille | Mamie4Family')
@section('description', "Espace Famille : visualisez et gérez vos messages reçus et envoyés aux mamies.")

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="p-6 bg-ivory min-h-screen">
    <h1 id="page-title" class="text-3xl font-extrabold text-marron-fonce mb-8 flex items-center gap-2">
        💌 Mes messages
    </h1>

    {{-- ✅ Message de succès --}}
    @if (session('success'))
        <div role="alert"
             class="mb-6 px-4 py-3 rounded-lg border border-green-400 bg-green-50 text-green-800 font-medium shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- ====================== --}}
    {{-- SECTION : MESSAGES REÇUS --}}
    {{-- ====================== --}}
    <section aria-labelledby="section-recus" class="mb-10">
        <h2 id="section-recus"
            class="text-xl font-semibold text-marron-fonce mb-4 flex items-center gap-2 border-b-2 border-caramel pb-2">
            📥 Messages reçus
        </h2>

        <div class="overflow-x-auto rounded-lg border border-caramel shadow bg-white">
            <table class="w-full text-sm text-gray-900" role="table">
                <thead class="bg-caramel-dark text-white uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-5 py-3 text-left">De</th>
                        <th scope="col" class="px-5 py-3 text-left">Extrait</th>
                        <th scope="col" class="px-5 py-3 text-left">Date</th>
                        <th scope="col" class="px-5 py-3 text-left">Statut</th>
                        <th scope="col" class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messagesRecus as $message)
                        <tr class="border-t hover:bg-caramel-light/30 focus-within:bg-caramel-light/40">
                            <td class="px-5 py-3 font-medium text-marron-fonce">
                                {{ $message->sender->name ?? '—' }}
                            </td>
                            <td class="px-5 py-3">{{ Str::limit($message->content, 80) }}</td>
                            <td class="px-5 py-3">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3">
                                @if($message->is_read)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        <span aria-hidden="true">🟢</span> Lu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                        <span aria-hidden="true">🔴</span> Non lu
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center space-x-2">
                                {{-- 👁 Voir --}}
                                <a href="{{ route('famille.messages.show', $message->id) }}"
                                   class="inline-block px-3 py-1 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition">
                                   👁 Voir
                                </a>
                                {{-- ✍️ Répondre --}}
                                <a href="{{ route('famille.messages.show', $message->id) }}#reply-form"
                                   class="inline-block px-3 py-1 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition">
                                   ✍️ Répondre
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center text-gray-600">Aucun message reçu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- ====================== --}}
    {{-- SECTION : MESSAGES ENVOYÉS --}}
    {{-- ====================== --}}
    <section aria-labelledby="section-envoyes">
        <h2 id="section-envoyes"
            class="text-xl font-semibold text-marron-fonce mb-4 flex items-center gap-2 border-b-2 border-caramel pb-2">
            📤 Messages envoyés
        </h2>

        <div class="overflow-x-auto rounded-lg border border-caramel shadow bg-white">
            <table class="w-full text-sm text-gray-900" role="table">
                <thead class="bg-caramel-dark text-white uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-5 py-3 text-left">À</th>
                        <th scope="col" class="px-5 py-3 text-left">Extrait</th>
                        <th scope="col" class="px-5 py-3 text-left">Date</th>
                        <th scope="col" class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messagesEnvoyes as $message)
                        <tr class="border-t hover:bg-caramel-light/30 focus-within:bg-caramel-light/40">
                            <td class="px-5 py-3 font-medium text-marron-fonce">
                                {{ $message->receiver->name ?? '—' }}
                            </td>
                            <td class="px-5 py-3">{{ Str::limit($message->content, 80) }}</td>
                            <td class="px-5 py-3">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3 text-center">
                                <a href="{{ route('famille.messages.show', $message->id) }}"
                                   class="inline-block px-3 py-1 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition">
                                   👁 Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-5 text-center text-gray-600">Aucun message envoyé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
