@extends('layouts.app')

@section('title', 'Inscription Famille | Mamie4Family')
@section('description', 'Créez votre compte Famille pour trouver une mamie disponible.')

@section('content')
    <main role="main" class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">👨‍👩‍👧 Inscription Famille</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nom --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirmation mot de passe --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de
                    passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            {{--  adrresse --}}
            <div class="mt-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input id="adresse" name="adresse" type="text" value="{{ old('adresse') }}" required
                    autocomplete="street-address"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-caramel focus:border-caramel">
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input id="ville" name="ville" type="text" value="{{ old('ville') }}" required
                        autocomplete="address-level2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-caramel focus:border-caramel">
                </div>
                <div>
                    <label for="arrondissement" class="block text-sm font-medium text-gray-700">Arrondissement</label>
                    <input id="arrondissement" name="arrondissement" type="text" value="{{ old('arrondissement') }}"
                        autocomplete="address-level3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-caramel focus:border-caramel">
                </div>
            </div>

            <div class="mt-4">
                <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
                <input id="departement" name="departement" type="text" value="{{ old('departement') }}" required
                    autocomplete="address-level1"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-caramel focus:border-caramel">
            </div>

            {{-- Téléphone --}}
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input id="telephone" name="telephone" type="text" value="{{ old('telephone') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Nombre d’enfants --}}
            <div class="mb-4">
                <label for="nombre_enfants" class="block text-sm font-medium text-gray-700">Nombre d’enfants</label>
                <input id="nombre_enfants" name="nombre_enfants" type="number" min="0"
                    value="{{ old('nombre_enfants', 0) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Prénoms des enfants --}}
            <div class="mb-4">
                <label for="enfants" class="block text-sm font-medium text-gray-700">Prénoms des enfants</label>
                <input id="enfants" name="enfants" type="text" value="{{ old('enfants') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <div>
                    <label for="photo" class="block text-sm font-medium">Photo de profil</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full border rounded">
                </div>
            </div>

            {{-- Rôle caché --}}
            <input type="hidden" name="role" value="famille">

            {{-- Bouton --}}
            <button type="submit" class="w-full py-2 px-4 bg-pink-600 text-white rounded hover:bg-pink-700">
                Créer mon compte Famille
            </button>
        </form>
    </main>
@endsection
