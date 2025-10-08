@extends('layouts.admin')

@section('title', 'Détails Famille - ' . ($famille->user->name ?? 'Famille'))
@section('description', 'Fiche détaillée d’une famille inscrite sur Mamie4Family.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="p-6">
    <h1 id="page-title" class="text-2xl font-bold mb-4">👨‍👩‍👧 Fiche Famille : {{ $famille->user->name }}</h1>

    <div class="bg-white rounded-lg shadow-md p-6 space-y-3 max-w-xl">
        <p><strong>Nom :</strong> {{ $famille->user->name }}</p>
        <p><strong>Email :</strong> {{ $famille->user->email }}</p>
        <p><strong>Adresse :</strong> {{ $famille->adresse ?? '—' }}</p>
        <p><strong>Ville :</strong> {{ $famille->ville ?? '—' }}</p>
        <p><strong>Département :</strong> {{ $famille->departement ?? '—' }}</p>
        <p><strong>Arrondissement :</strong> {{ $famille->arrondissement ?? '—' }}</p>
        <p><strong>Téléphone :</strong> {{ $famille->telephone ?? '—' }}</p>
        <p><strong>Nombre d’enfants :</strong> {{ $famille->nombre_enfants ?? '—' }}</p>
        <p><strong>Prénoms enfants :</strong> {{ $famille->enfants ?? '—' }}</p>
        @if($famille->photo)
            <p><strong>Photo :</strong></p>
            <img src="{{ asset('storage/' . $famille->photo) }}" alt="Photo de la famille {{ $famille->user->name }}" class="rounded-md w-40 h-40 object-cover">
        @endif
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('admin.familles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 focus:ring-2 focus:ring-gray-400" aria-label="Retour à la liste des familles">
            ⬅ Retour
        </a>

        <a href="{{ route('admin.familles.edit', $famille->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400" aria-label="Modifier cette famille">
            ✏️ Modifier
        </a>
    </div>
</main>
@endsection
