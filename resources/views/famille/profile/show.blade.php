@extends('layouts.famille')

@section('title', 'Mon Profil Famille | Mamie4Family')
@section('description', 'Consultez et gérez les informations de votre profil Famille sur Mamie4Family.')

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="max-w-5xl mx-auto">
    
    {{-- BOUTON RETOUR --}}
    <div class="flex justify-start mb-6">
        <a href="{{ route('famille.dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce"
           aria-label="Retour au tableau de bord famille">
            ⬅ Retour au tableau de bord
        </a>
    </div>

    {{-- TITRE --}}
    <h1 id="page-title" class="text-3xl font-bold mb-6 text-marron-fonce">
        ⚙️ Mon profil
    </h1>

    {{-- INFOS GÉNÉRALES --}}
    <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 space-y-4">
        <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">👨‍👩‍👧 Informations générales</h2>

        <ul class="space-y-2 text-marron-fonce">
            <li><strong>Nom :</strong> {{ $famille->user->name ?? '—' }}</li>
            <li><strong>Email :</strong> {{ $famille->user->email ?? '—' }}</li>
            <li><strong>Téléphone :</strong> {{ $famille->telephone ?? '—' }}</li>
            <li><strong>Adresse :</strong> {{ $famille->adresse ?? '—' }}</li>
            <li><strong>Ville :</strong> {{ $famille->ville ?? '—' }}</li>
            <li><strong>Arrondissement :</strong> {{ $famille->arrondissement ?? '—' }}</li>
            <li><strong>Département :</strong> {{ $famille->departement ?? '—' }}</li>
        </ul>
    </div>

    {{-- SECTION ENFANTS --}}
    <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">👶 Enfants</h2>

        @if(!empty($famille->nombre_enfants))
            <p><strong>Nombre d’enfants :</strong> {{ $famille->nombre_enfants }}</p>

            @if(!empty($famille->prenoms_enfants))
                <p><strong>Prénoms :</strong> {{ $famille->prenoms_enfants }}</p>
            @endif

            @if(!empty($famille->ages_enfants))
                <p><strong>Âges :</strong> {{ $famille->ages_enfants }}</p>
            @endif
        @else
            <p class="text-gray-600">Aucune information sur les enfants n’a été renseignée.</p>
        @endif
    </div>

    {{-- SECTION AUTRES INFOS --}}
    <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">📋 Autres informations</h2>

        @if(!empty($famille->besoin_principal))
            <p><strong>Besoin principal :</strong> {{ $famille->besoin_principal }}</p>
        @else
            <p class="text-gray-600">Aucun besoin spécifique indiqué pour le moment.</p>
        @endif

        @if(!empty($famille->disponibilites))
            <p><strong>Disponibilités :</strong> {{ $famille->disponibilites }}</p>
        @endif
    </div>

    {{-- BOUTON MODIFIER --}}
    <div class="flex justify-end mt-8">
        <a href="{{ route('famille.profile.edit', $famille->id) }}"
           class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce"
           aria-label="Modifier le profil famille">
            ✏️ Modifier mon profil
        </a>
    </div>
</main>
@endsection
