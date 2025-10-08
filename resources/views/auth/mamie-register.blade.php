@extends('layouts.app')

@section('title', 'Inscription Mamie | Mamie4Family')
@section('description', 'Créez votre compte Mamie pour proposer vos services aux familles.')

@section('content')
<main role="main" aria-labelledby="page-title" class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 id="page-title" class="text-2xl font-bold mb-6 text-center">👵 Inscription Mamie</h1>

    <form method="POST" action="{{ route('register.mamie.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Mot de passe --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" name="password" type="password" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Confirmation --}}
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input id="adresse" name="adresse" type="text" value="{{ old('adresse') }}" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Ville / Département / Arrondissement --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                <input id="ville" name="ville" type="text" value="{{ old('ville') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
            </div>

            <div>
                <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
                <input id="departement" name="departement" type="text" value="{{ old('departement') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
            </div>

            <div>
                <label for="arrondissement" class="block text-sm font-medium text-gray-700">Arrondissement</label>
                <input id="arrondissement" name="arrondissement" type="text" value="{{ old('arrondissement') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
            </div>
        </div>

        {{-- Bio --}}
        <div class="mb-4">
            <label for="bio" class="block text-sm font-medium text-gray-700">Présentation</label>
            <textarea id="bio" name="bio" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel"
                placeholder="Parlez un peu de vous...">{{ old('bio') }}</textarea>
        </div>

        {{-- Services --}}
        <div class="mb-4">
            <label for="services" class="block text-sm font-medium text-gray-700">Services proposés</label>
            <input id="services" name="services" type="text" value="{{ old('services') }}"
                placeholder="Ex : garde d’enfants, cuisine, aide aux devoirs"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Tarif --}}
        <div class="mb-4">
            <label for="tarif" class="block text-sm font-medium text-gray-700">Tarif horaire net (€)</label>
            <input id="tarif" name="tarif" type="number" step="0.1" value="{{ old('tarif') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Photo --}}
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo (portrait)</label>
            <input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.webp"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Upload CNI --}}
        <div class="mb-4">
            <label for="cni" class="block text-sm font-medium text-gray-700">Carte d’identité (PDF ou image)</label>
            <input id="cni" name="cni" type="file" accept=".pdf,.jpg,.jpeg,.png"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Bouton --}}
        <button type="submit"
            class="w-full py-2 px-4 bg-caramel text-white rounded hover:bg-marron-fonce focus:ring-2 focus:ring-caramel focus:outline-none">
            Créer mon compte Mamie
        </button>
    </form>
</main>
@endsection
