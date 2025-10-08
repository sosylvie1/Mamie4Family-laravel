@extends('layouts.mamie')

@section('title', 'Annuaire des Familles - Mamie4Family')
@section('description', 'Consultez la liste des familles inscrites sur Mamie4Family.')

@section('mamie-content')
<main role="main" aria-labelledby="page-title" class="max-w-7xl mx-auto px-6 py-12">
    <h1 id="page-title" class="text-3xl font-bold text-center mb-8 text-marron-fonce">
        👨‍👩‍👧 Annuaire des Familles
    </h1>

    {{-- FORMULAIRE DE RECHERCHE --}}
    <form method="GET" action="{{ route('mamie.familles.index') }}" class="max-w-xl mx-auto mb-8 flex">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Rechercher par adresse ou département..."
               aria-label="Rechercher une famille"
               class="flex-1 px-4 py-3 border border-caramel-pastel rounded-l-lg focus:ring-caramel focus:border-caramel">
        <button type="submit"
                class="px-6 py-3 bg-caramel text-white font-bold rounded-r-lg hover:bg-caramel-fonce">
            🔍
        </button>
    </form>

    {{-- LISTE DES FAMILLES --}}
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($familles as $famille)
            <article class="bg-white shadow rounded-lg p-6 border border-caramel-pastel">
                <h2 class="text-lg font-semibold text-marron-fonce">{{ $famille->name }}</h2>
                <p class="text-sm text-gray-600">
                    {{ $famille->familleProfile->departement ?? 'Département non renseigné' }}
                </p>
                <p class="mt-2 text-sm text-taupe">
                    {{ Str::limit($famille->familleProfile->details_enfants ?? 'Pas encore de description', 80) }}
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    <strong>Nombre d’enfants :</strong> {{ $famille->familleProfile->nombre_enfants ?? 'Non renseigné' }}
                </p>

                {{-- Bouton --}}
                <div class="mt-4 text-center">
                    <a href="{{ route('mamie.familles.show', $famille->id) }}"
                       class="px-3 py-1 bg-sauge text-white rounded hover:bg-olive"
                       aria-label="Voir le profil complet de {{ $famille->name }}">
                        Voir
                    </a>
                </div>
            </article>
        @empty
            <p class="text-center col-span-full text-taupe">Aucune famille trouvée pour cette recherche.</p>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8">
        {{ $familles->appends(request()->input())->links() }}
    </div>
</main>
@endsection
