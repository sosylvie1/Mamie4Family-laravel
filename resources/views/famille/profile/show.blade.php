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
        {{-- Message de succès après modification --}}
        @if (session('success'))
            <div role="alert" class="mb-6 p-4 border-l-4 border-green-600 bg-green-50 text-green-800 rounded-lg shadow-sm"
                aria-live="assertive">
                <p class="font-semibold"> {{ session('success') }}</p>
            </div>
        @endif

        {{-- Message d’erreur éventuel --}}
        @if (session('error'))
            <div role="alert" class="mb-6 p-4 border-l-4 border-red-600 bg-red-50 text-red-800 rounded-lg shadow-sm"
                aria-live="assertive">
                <p class="font-semibold"> {{ session('error') }}</p>
            </div>
        @endif

        {{-- INFOS GÉNÉRALES --}}
        <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 space-y-4">
            <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">👨‍👩‍👧 Informations générales</h2>

            <ul class="space-y-2 text-marron-fonce">
                <li><strong>Nom :</strong> {{ $familleProfile->user->name ?? '—' }}</li>
                <li><strong>Email :</strong> {{ $familleProfile->user->email ?? '—' }}</li>
                <li><strong>Téléphone :</strong> {{ $familleProfile->telephone ?? '—' }}</li>
                <li><strong>Adresse :</strong> {{ $familleProfile->adresse ?? '—' }}</li>
                <li><strong>Ville :</strong> {{ $familleProfile->ville ?? '—' }}</li>
                <li><strong>Code postal :</strong> {{ $familleProfile->code_postal ?? '—' }}</li>
                <li><strong>Arrondissement :</strong> {{ $familleProfile->arrondissement ?? '—' }}</li>
                <li><strong>Département :</strong> {{ $familleProfile->departement ?? '—' }}</li>
            </ul>

            @if ($familleProfile->photo)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $familleProfile->photo) }}"
                        alt="Photo de la famille {{ $familleProfile->user->name }}"
                        class="h-32 w-32 rounded-lg shadow-md object-cover">
                </div>
            @endif
        </div>

        {{-- SECTION ENFANTS --}}
        <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">👶 Enfants</h2>

            @if ($familleProfile->enfants->isNotEmpty())
                <p><strong>Nombre d’enfants :</strong> {{ $familleProfile->enfants->count() }}</p>

                <ul class="divide-y divide-gray-200 border border-gray-200 rounded-lg mt-3">
                    @foreach ($familleProfile->enfants as $enfant)
                        <li class="p-3 flex justify-between {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <span class="font-medium text-gray-800">{{ $enfant->nom }}</span>
                            <span class="text-gray-600">{{ $enfant->age }} ans</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">Aucune information sur les enfants n’a été renseignée.</p>
            @endif
        </div>

        {{-- SECTION AUTRES INFOS (optionnelle, si tu veux les garder) --}}
        @if (!empty($familleProfile->besoin_principal) || !empty($familleProfile->disponibilites))
            <div class="bg-white border border-caramel rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-2xl font-semibold mb-4 text-marron-fonce">📋 Autres informations</h2>

                @if (!empty($familleProfile->besoin_principal))
                    <p><strong>Besoin principal :</strong> {{ $familleProfile->besoin_principal }}</p>
                @endif

                @if (!empty($familleProfile->disponibilites))
                    <p><strong>Disponibilités :</strong> {{ $familleProfile->disponibilites }}</p>
                @endif
            </div>
        @endif

        {{-- BOUTON MODIFIER --}}
        <div class="flex justify-end mt-8">
            <a href="{{ route('famille.profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce"
                aria-label="Modifier le profil famille">
                ✏️ Modifier mon profil
            </a>
        </div>
    </main>
@endsection
