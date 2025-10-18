@extends('layouts.app')

@section('title', 'Inscription Famille | Mamie4Family')
@section('description', 'Créez votre compte famille pour contacter nos mamies disponibles près de chez vous.')

@section('content')
<main role="main" aria-labelledby="page-title" class="max-w-2xl mx-auto my-12 p-6 bg-white rounded-2xl shadow">
    <h1 id="page-title" class="text-2xl font-bold text-center text-marron-fonce mb-6">
        👨‍👩‍👧 Inscription Famille
    </h1>

    <form method="POST" action="{{ route('register.famille.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Mot de passe --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Confirmation --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Adresse --}}
        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input id="adresse" type="text" name="adresse" value="{{ old('adresse') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Ville --}}
        <div>
            <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
            <input id="ville" type="text" name="ville" value="{{ old('ville') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Département --}}
        <div>
            <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
            <input id="departement" type="text" name="departement" value="{{ old('departement') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Arrondissement --}}
        <div>
            <label for="arrondissement" class="block text-sm font-medium text-gray-700">Arrondissement (facultatif)</label>
            <input id="arrondissement" type="text" name="arrondissement" value="{{ old('arrondissement') }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone (facultatif)</label>
            <input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Nombre d'enfants --}}
        <div>
            <label for="nombre_enfants" class="block text-sm font-medium text-gray-700">Nombre d’enfants</label>
            <input id="nombre_enfants" type="number" name="nombre_enfants" min="0" value="{{ old('nombre_enfants') }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Photo --}}
        <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo (facultatif)</label>
            <input id="photo" type="file" name="photo" accept="image/*"
                class="mt-1 block w-full text-sm border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Liste des enfants --}}
        <fieldset class="mt-6 border-t border-gray-300 pt-4">
            <legend class="text-lg font-semibold text-marron-fonce">👧 Informations sur vos enfants</legend>
            <div id="children-fields" class="mt-3 space-y-3">
                <div class="child-item">
                    <label class="block text-sm text-gray-700">Nom de l’enfant</label>
                    <input type="text" name="enfants[0][nom]" class="w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">

                    <label class="block text-sm text-gray-700 mt-2">Âge</label>
                    <input type="number" name="enfants[0][age]" class="w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
                </div>
            </div>

            <button type="button" id="add-child"
                class="mt-3 bg-caramel text-white px-3 py-1 rounded hover:bg-caramel-pastel focus:ring-2 focus:ring-caramel">
                ➕ Ajouter un enfant
            </button>
        </fieldset>

        {{-- Bouton d'inscription --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-caramel text-white py-2 px-4 rounded-md hover:bg-caramel-pastel focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                🧾 Créer mon compte Famille
            </button>
        </div>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
        Déjà inscrit ? <a href="{{ route('login') }}" class="text-caramel hover:underline">Se connecter</a>
    </p>
</main>

{{-- Script dynamique enfants --}}
<script>
document.getElementById('add-child').addEventListener('click', function() {
    const container = document.getElementById('children-fields');
    const index = container.children.length;
    const div = document.createElement('div');
    div.classList.add('child-item');
    div.innerHTML = `
        <hr class="my-3 border-gray-200">
        <label class="block text-sm text-gray-700">Nom de l’enfant</label>
        <input type="text" name="enfants[${index}][nom]" class="w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        <label class="block text-sm text-gray-700 mt-2">Âge</label>
        <input type="number" name="enfants[${index}][age]" class="w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
    `;
    container.appendChild(div);
});
</script>
@endsection
