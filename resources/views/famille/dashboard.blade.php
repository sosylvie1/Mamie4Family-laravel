@extends('layouts.famille')

@section('title', 'Tableau de bord Famille | Mamie4Family')
@section('description', 'Espace personnel de la famille sur Mamie4Family.')

@section('famille-content')
    <main role="main" aria-labelledby="page-title" class="space-y-8">
        {{-- 🎯 Titre principal --}}
        <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-2">👨‍👩‍👧 Tableau de bord Famille</h1>

        {{-- ✅ Message de bienvenue accessible --}}
        <section role="status" aria-live="polite"
            class="bg-caramel-pastel text-marron-fonce p-4 rounded shadow focus-within:ring-2 focus-within:ring-caramel">
            <p class="text-lg font-medium">
                Bienvenue, <strong>{{ $famille->name }}</strong> 👋
                Vous êtes connecté(e) à votre espace Famille.
            </p>
        </section>

        {{-- ✅ Cartes statistiques accessibles --}}
        <section role="region" aria-label="Statistiques principales" class="grid md:grid-cols-3 gap-6 mt-4">

            {{-- 💬 Messages --}}
            <article role="group" aria-labelledby="card-messages"
                class="bg-[#E7C6A8] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
                <h2 id="card-messages" class="text-xl font-bold text-marron-fonce">💬 Messages</h2>
                <p class="text-4xl font-extrabold text-marron-fonce mt-2">{{ $messagesCount }}</p>
                <p class="text-base text-marron-fonce mt-1">
                    {{ $messagesEnvoyes }} envoyés • {{ $messagesRecus }} reçus
                </p>
                <a href="{{ route('famille.messages.index') }}"
                    class="mt-3 inline-block text-sm text-marron-fonce font-medium underline hover:text-marron-fonce/80 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                    Voir tous les messages →
                </a>
            </article>

            {{-- 👵 Mamies contactées --}}
<article class="bg-[#B7D3A8] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition"
         role="group" aria-labelledby="card-mamies">
    <h2 id="card-mamies" class="text-xl font-bold text-marron-fonce flex justify-center gap-2">
        👵 Mamies
    </h2>
    <p class="text-4xl font-extrabold text-marron-fonce mt-2">{{ $mamiesContactees }}</p>
    <p class="text-base text-marron-fonce mt-1">
        Mamies que vous avez contactées
    </p>
    <a href="{{ route('famille.mamies.index') }}"
       class="mt-3 inline-block text-sm text-marron-fonce font-medium underline hover:text-marron-fonce/80 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
        Voir les mamies →
    </a>
</article>




            {{-- ⚙️ Mon profil --}}
            <article role="group" aria-labelledby="card-profil"
                class="bg-[#EBC0B0] p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
                <h2 id="card-profil" class="text-xl font-bold text-marron-fonce">⚙️ Mon profil</h2>
                <p class="text-base text-marron-fonce mt-2">
                    Mettez à jour vos informations personnelles.
                </p>
                <a href="{{ route('famille.profile.show') }}"
                    class="mt-3 inline-block text-sm text-red-700 font-semibold underline hover:text-red-800 focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                    Modifier le profil →
                </a>
            </article>
        </section>

        {{-- ✅ Derniers messages reçus --}}
        <section role="region" aria-labelledby="recent-messages"
            class="bg-white p-6 rounded-xl shadow border border-caramel-pastel">
            <h2 id="recent-messages" class="text-2xl font-bold mb-4 text-marron-fonce flex items-center gap-2">
                <span aria-hidden="true">📩</span> Derniers messages reçus
            </h2>
            <ul class="divide-y divide-caramel-pastel">
                @forelse($messages as $message)
                    <li class="py-3" role="article" aria-label="Message reçu">
                        <p class="text-sm text-gray-700">
                            <strong>De :</strong> {{ $message->sender->name ?? '—' }}
                            <span class="text-xs text-gray-500 ml-2">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </span>
                        </p>
                        <p class="text-marron-fonce mt-1">{{ Str::limit($message->content, 80) }}</p>
                        <a href="{{ route('famille.messages.show', $message->id) }}"
                            class="text-caramel text-sm font-medium underline hover:text-caramel-fonce focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
                            Lire le message →
                        </a>
                    </li>
                @empty
                    <li class="py-3 text-gray-600">Aucun message reçu pour l’instant.</li>
                @endforelse
            </ul>
        </section>
    </main>
@endsection
