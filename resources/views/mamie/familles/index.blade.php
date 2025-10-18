@extends('layouts.mamie')

@section('title', 'Familles qui vous ont contactée - Mamie4Family')
@section('description', 'Liste des familles ayant pris contact avec vous sur Mamie4Family.')

@section('mamie-content')
<main role="main" aria-labelledby="page-title" class="max-w-7xl mx-auto px-6 py-12">
    <h1 id="page-title" class="text-3xl font-bold text-center mb-8 text-marron-fonce">
        👨‍👩‍👧 Familles qui vous ont contactée
    </h1>

    {{-- 🔎 Formulaire de recherche facultatif --}}
    <form method="GET" action="{{ route('mamie.familles.index') }}" class="max-w-xl mx-auto mb-8 flex">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Rechercher par adresse ou département..."
               aria-label="Rechercher une famille"
               class="flex-1 px-4 py-3 border border-caramel-pastel rounded-l-lg focus:ring-caramel focus:border-caramel">
        <button type="submit"
                class="px-6 py-3 bg-caramel text-white font-bold rounded-r-lg hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
            🔍
        </button>
    </form>

    {{-- 🧩 Liste des familles --}}
    @if ($familles->isEmpty())
        <div class="text-center p-6 bg-beige-clair rounded-lg shadow mt-6" role="status">
            <p class="text-lg text-marron-fonce font-medium">
                Aucune famille ne vous a encore contactée 💌
            </p>
            <p class="text-sm text-gray-600 mt-2">
                Dès qu'une famille vous écrira, elle apparaîtra ici.
            </p>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($familles as $famille)
                <article class="bg-white shadow rounded-lg p-6 border border-caramel-pastel hover:shadow-lg transition" 
                         role="article" aria-labelledby="famille-{{ $famille->id }}">
                    <h2 id="famille-{{ $famille->id }}" class="text-lg font-semibold text-marron-fonce">
                        {{ $famille->name }}
                    </h2>

                    <p class="text-sm text-gray-600">
                        {{ $famille->familleProfile->departement ?? 'Département non renseigné' }}
                    </p>

                    {{-- 📝 Description courte --}}
                    <p class="mt-2 text-sm text-gray-700 line-clamp-2">
                        {{ $famille->familleProfile->description ?? 'Pas encore de description' }}
                    </p>

                    {{-- 👶 Nombre d’enfants --}}
                    <p class="mt-1 text-sm text-gray-700">
                        <strong>Nombre d’enfants :</strong>
                        {{ $famille->familleProfile->enfants->count() ?? 'Non renseigné' }}
                    </p>

                    {{-- 🔗 Bouton de visualisation --}}
                    <div class="mt-4 text-center">
                        <a href="{{ route('mamie.familles.show', $famille->id) }}"
                           class="px-4 py-2 bg-sauge text-white font-medium rounded-lg hover:bg-olive transition focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-caramel"
                           aria-label="Voir le profil complet de {{ $famille->name }}">
                            Voir
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- 🔄 Pagination --}}
        <div class="mt-8">
            {{ $familles->appends(request()->input())->links() }}
        </div>
    @endif
</main>
@endsection
