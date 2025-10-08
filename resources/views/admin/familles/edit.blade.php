@extends('layouts.admin')

@section('title', 'Modifier Famille - ' . ($famille->user->name ?? 'Famille'))
@section('description', 'Formulaire d’édition du profil de la famille dans l’espace d’administration.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="p-6">
    <h1 id="page-title" class="text-2xl font-bold mb-4">✏️ Modifier la Famille</h1>

    <form action="{{ route('admin.familles.update', $famille->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label for="adresse" class="block font-medium">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $famille->adresse) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label for="ville" class="block font-medium">Ville</label>
            <input type="text" id="ville" name="ville" value="{{ old('ville', $famille->ville) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="departement" class="block font-medium">Département</label>
            <input type="text" id="departement" name="departement" value="{{ old('departement', $famille->departement) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="arrondissement" class="block font-medium">Arrondissement</label>
            <input type="text" id="arrondissement" name="arrondissement" value="{{ old('arrondissement', $famille->arrondissement) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="telephone" class="block font-medium">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $famille->telephone) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="nombre_enfants" class="block font-medium">Nombre d’enfants</label>
            <input type="number" id="nombre_enfants" name="nombre_enfants" value="{{ old('nombre_enfants', $famille->nombre_enfants) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="enfants" class="block font-medium">Prénoms des enfants</label>
            <input type="text" id="enfants" name="enfants" value="{{ old('enfants', $famille->enfants) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="photo" class="block font-medium">Photo (optionnelle)</label>
            <input type="file" id="photo" name="photo" class="w-full border rounded p-2">
            @if($famille->photo)
                <p class="mt-2 text-sm text-gray-600">Photo actuelle :</p>
                <img src="{{ asset('storage/' . $famille->photo) }}" alt="Photo actuelle" class="mt-1 rounded-md w-32 h-32 object-cover">
            @endif
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.familles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 focus:ring-2 focus:ring-gray-400" aria-label="Retour à la liste">
                ⬅ Retour
            </a>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:ring-2 focus:ring-green-400">
                💾 Enregistrer
            </button>
        </div>
    </form>
</main>
@endsection
