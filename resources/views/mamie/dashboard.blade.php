@extends('layouts.mamie')

@section('title', 'Tableau de bord Mamie | Mamie4Family')
@section('description', 'Espace personnel de la mamie sur Mamie4Family.')

@section('mamie-content')
<main role="main" aria-labelledby="page-title" class="space-y-8">
    {{-- 🎯 Titre principal --}}
    <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-2">👵 Tableau de bord Mamie</h1>

    {{-- ✅ Message de bienvenue accessible --}}
    <section role="status" aria-live="polite"
             class="bg-caramel-pastel text-marron-fonce p-4 rounded shadow focus-within:ring-2 focus-within:ring-caramel">
        <p class="text-lg font-medium">
            Bienvenue, <strong>{{ $mamie->name }}</strong> 🌷  
            Vous êtes connectée à votre espace Mamie.
        </p>
    </section>

    {{-- ✅ Cartes statistiques accessibles --}}
    <section role="region" aria-label="Statistiques principales" class="grid md:grid-cols-3 gap-6 mt-4">

        {{-- 💬 Messages reçus --}}
        <article role="group" aria-labelledby="card-messages"
                 class="bg-[#E7C6A8] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
            <h2 id="card-messages" class="text-xl font-bold text-marron-fonce">💬 Messages</h2>
            <p class="text-4xl font-extrabold text-marron-fonce mt-2">{{ $mamie->receivedMessages()->count() ?? 0 }}</p>
            <p class="text-base text-marron-fonce mt-1">Messages reçus</p>
            <a href="{{ route('mamie.messages.index') }}"
               class="mt-3 inline-block text-sm text-marron-fonce font-medium underline hover:text-marron-fonce/80 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                Voir mes messages →
            </a>
        </article>

        
         {{-- 👨‍👩‍👧‍👦 Familles contactées --}}
        <article class="bg-[#B7D3A8] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition"
                 role="group" aria-labelledby="card-familles">
            <h2 id="card-familles" class="text-xl font-bold text-marron-fonce flex justify-center gap-2">
                👨‍👩‍👧‍👦 Familles
            </h2>
            <p class="text-4xl font-extrabold text-marron-fonce mt-2">{{ $famillesContact }}</p>
            <p class="text-base text-marron-fonce mt-1">
                Familles qui vous ont contactée
            </p>
            <a href="{{ route('mamie.familles.index') }}"
               class="mt-3 inline-block text-sm text-marron-fonce font-medium underline hover:text-marron-fonce/80 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                Voir les familles →
            </a>
        </article>

        {{-- ⚙️ Mon profil --}}
        <article role="group" aria-labelledby="card-profil"
                 class="bg-[#EBC0B0] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
            <h2 id="card-profil" class="text-xl font-bold text-marron-fonce">⚙️ Mon profil</h2>
            <p class="text-base text-marron-fonce mt-2">
                Mettez à jour vos informations personnelles.
            </p>
            <a href="{{ route('mamie.profile.show') }}"
               class="mt-3 inline-block text-sm text-red-700 font-semibold underline hover:text-red-800 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                Modifier mon profil →
            </a>
        </article>
    </section>

    {{-- ✅ Derniers messages reçus --}}
    <section role="region" aria-labelledby="recent-messages" class="bg-white p-6 rounded-xl shadow border border-caramel-pastel">
        <h2 id="recent-messages" class="text-2xl font-bold mb-4 text-marron-fonce flex items-center gap-2">
            <span aria-hidden="true">📩</span> Derniers messages reçus
        </h2>
        <ul class="divide-y divide-caramel-pastel">
            @forelse($mamie->receivedMessages()->latest()->take(5)->get() as $message)
                <li class="py-3" role="article" aria-label="Message reçu">
                    <p class="text-sm text-gray-700">
                        <strong>De :</strong> {{ $message->sender->name ?? '—' }}
                        <span class="text-xs text-gray-500 ml-2">
                            {{ $message->created_at->format('d/m/Y H:i') }}
                        </span>
                    </p>
                    <p class="text-marron-fonce mt-1">{{ Str::limit($message->content, 80) }}</p>
                    <a href="{{ route('mamie.messages.show', $message->id) }}"
                       class="text-caramel text-sm font-medium underline hover:text-caramel-fonce focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                        Lire le message →
                    </a>
                </li>
            @empty
                <li class="py-3 text-gray-600">Aucun message reçu pour l’instant.</li>
            @endforelse
        </ul>
    </section>

    
    </section>
</main>
@endsection
