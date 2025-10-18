@extends('layouts.app')

@section('title', 'Catalogue des Mamies | Mamie4Family')
@section('description', 'Découvrez toutes les mamies disponibles pour garder vos enfants ou partager du temps à proximité.')

@section('content')
<main role="main" class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6 text-marron-fonce text-center">
        🧓 Nos Mamies disponibles
    </h1>

    {{-- Barre de recherche --}}
    <form method="GET" action="{{ route('mamies.index') }}" class="mb-6 flex flex-col sm:flex-row sm:items-center gap-3 justify-center">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="🔍 Rechercher par ville ou service..."
               class="w-full sm:w-1/2 px-4 py-2 border border-caramel-pastel rounded focus:ring-2 focus:ring-caramel outline-none"
               aria-label="Rechercher une mamie par ville ou par service">
        <button type="submit"
                class="px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-caramel-fonce focus:ring-offset-2 transition-all">
            Rechercher
        </button>
    </form>

    {{-- Liste des mamies --}}
    @if ($mamies->count())
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($mamies as $mamie)
                @php $profile = $mamie->mamieProfile; @endphp

                <div class="card border border-caramel-pastel rounded-lg p-4 shadow-sm hover:shadow-md transition-all">
                    <img src="{{ $profile?->photo ? asset('storage/'.$profile->photo) : asset('images/default-mamie.png') }}"
                         alt="Photo de {{ $mamie->name }}"
                         class="w-full h-48 object-cover rounded-md mb-3">

                    <h3 class="text-lg font-semibold text-marron-fonce">{{ $mamie->name }}</h3>

                    <p class="text-gray-700">📍 {{ $profile?->ville ?? 'Ville non renseignée' }}</p>
                    <p class="text-gray-700">💬 {{ $profile?->bio ?? 'Aucune description disponible.' }}</p>

                    <a href="{{ route('mamies.show', $profile->id) }}"
                       class="mt-2 inline-block px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-caramel-fonce">
                        👀 Voir profil
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $mamies->links() }}
        </div>

    @else
        {{-- Aucun résultat --}}
        <div class="text-center py-12 bg-sable-clair rounded-xl border border-caramel-pastel shadow-sm">
            <p role="alert" class="text-lg font-semibold text-marron-fonce mb-4">
                😢 Aucune mamie trouvée pour cette recherche.
            </p>

            <a href="{{ route('mamies.index') }}"
               class="inline-flex items-center px-5 py-2 bg-caramel text-white rounded-lg hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce transition-all"
               aria-label="Retourner au catalogue complet des mamies">
                ⬅ Retour au catalogue complet
            </a>
        </div>
    @endif

    {{-- 🔙 Bouton retour au dashboard Famille (si connecté et rôle famille) --}}
    @auth
        @if(auth()->user()->isFamille())
            <div class="flex justify-start mt-10">
                <a href="{{ route('famille.dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce"
                   aria-label="Retour au tableau de bord famille">
                    ⬅ Retour au tableau de bord
                </a>
            </div>
        @endif
    @endauth
</main>
@endsection
