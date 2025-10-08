@extends('layouts.famille')

@section('title', 'Annuaire des Mamies - Mamie4Family')
@section('description', 'Consultez la liste des mamies disponibles sur Mamie4Family.')

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="max-w-7xl mx-auto px-6 py-12">
    <h1 id="page-title" class="text-3xl font-bold text-center mb-8 text-marron-fonce">
        👵 Annuaire des Mamies
    </h1>

    {{-- FORMULAIRE DE RECHERCHE --}}
    <form method="GET" action="{{ route('famille.mamies.index') }}" class="max-w-xl mx-auto mb-8 flex">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Rechercher par ville ou service..."
               aria-label="Rechercher une mamie"
               class="flex-1 px-4 py-3 border border-caramel-pastel rounded-l-lg focus:ring-caramel focus:border-caramel">
        <button type="submit"
                class="px-6 py-3 bg-caramel text-white font-bold rounded-r-lg hover:bg-caramel-fonce">
            🔍
        </button>
    </form>

    {{-- LISTE DES MAMIES --}}
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($mamies as $mamie)
            <article class="bg-white shadow rounded-lg p-6 border border-caramel-pastel">
                {{-- Photo --}}
                <div class="flex justify-center mb-4">
                    @if($mamie->mamieProfile && $mamie->mamieProfile->photo)
                        <img src="{{ asset('storage/' . $mamie->mamieProfile->photo) }}"
                             alt="Photo de {{ $mamie->name }}"
                             class="w-24 h-24 object-cover rounded-full shadow">
                    @else
                        <div class="w-24 h-24 flex items-center justify-center rounded-full bg-caramel text-white text-2xl">
                            👵
                        </div>
                    @endif
                </div>

                {{-- Infos --}}
                <h2 class="text-lg font-semibold text-marron-fonce text-center">{{ $mamie->name }}</h2>
                <p class="text-sm text-gray-600 text-center">
                    {{ $mamie->mamieProfile->ville ?? 'Ville non renseignée' }}
                </p>
                <p class="mt-2 text-sm text-taupe">
                    {{ Str::limit($mamie->mamieProfile->services ?? 'Pas encore de services renseignés', 80) }}
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    <strong>Tarif :</strong>
                    {{ $mamie->mamieProfile->tarif ? $mamie->mamieProfile->tarif . ' € / heure' : 'Non renseigné' }}
                </p>

                {{-- Bouton --}}
                <div class="mt-4 text-center">
                    <a href="{{ route('famille.mamies.show', $mamie->id) }}"
                       class="px-3 py-1 bg-sauge text-white rounded hover:bg-olive"
                       aria-label="Voir le profil complet de {{ $mamie->name }}">
                        Voir
                    </a>
                </div>
            </article>
        @empty
            <p class="text-center col-span-full text-taupe">Aucune mamie trouvée pour cette recherche.</p>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8">
        {{ $mamies->appends(request()->input())->links() }}
    </div>
</main>
@endsection
