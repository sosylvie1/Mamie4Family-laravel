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
               class="w-full sm:w-1/2 px-4 py-2 border border-caramel-pastel rounded focus:ring-2 focus:ring-caramel outline-none">
        <button type="submit"
                class="px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-pastel focus:ring-2 focus:ring-caramel-fonce">
            Rechercher
        </button>
    </form>

    {{-- 🔙 Bouton retour au catalogue complet si une recherche est active --}}
    @if(request('q'))
        <div class="text-center mb-8">
            <a href="{{ route('mamies.index') }}"
               class="inline-block px-4 py-2 bg-gray-200 text-marron-fonce rounded hover:bg-gray-300 focus:ring-2 focus:ring-caramel-fonce">
                ⬅ Retour au catalogue complet
            </a>
        </div>
    @endif

    {{-- Liste des mamies --}}
    @if ($mamies->count())
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($mamies as $mamie)
                @php $profile = $mamie->mamieProfile; @endphp

                <div class="card border border-caramel-pastel rounded-lg p-4 shadow-sm">
                    <img src="{{ $profile?->photo ? asset('storage/'.$profile->photo) : asset('images/default-mamie.png') }}"
                         alt="Photo de {{ $mamie->name }}"
                         class="w-full h-48 object-cover rounded-md mb-3">

                    <h3 class="text-lg font-semibold">{{ $mamie->name }}</h3>

                    <p>📍 {{ $profile?->ville ?? 'Ville non renseignée' }}</p>
                    <p>💬 {{ $profile?->bio ?? 'Aucune description disponible.' }}</p>

                    <a href="{{ route('mamies.show', $profile->id) }}"
                       class="mt-2 inline-block px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce">
                        👀 Voir profil
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $mamies->links() }}
        </div>
    @else
        <p class="text-gray-700 text-center mt-8">Aucune mamie trouvée pour le moment.</p>
    @endif
    {{-- 🔙 Bouton retour au dashboard Famille (si connecté et rôle famille) --}}
    @auth
        @if(auth()->user()->isFamille())
            <div class="flex justify-start mb-4">
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
