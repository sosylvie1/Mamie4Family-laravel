@extends('layouts.famille')

@section('title', 'Modifier mon profil | Famille')
@section('description', 'Formulaire de mise à jour du profil famille sur Mamie4Family.')

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-4">✏️ Modifier mon profil</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- Affichage erreurs --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('famille.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Adresse --}}
        <div>
            <label for="adresse" class="block text-sm font-medium text-marron-fonce">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $profile->adresse) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Ville --}}
        <div>
            <label for="ville" class="block text-sm font-medium text-marron-fonce">Ville</label>
            <input type="text" id="ville" name="ville" value="{{ old('ville', $profile->ville) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Département --}}
        <div>
            <label for="departement" class="block text-sm font-medium text-marron-fonce">Département</label>
            <input type="text" id="departement" name="departement" value="{{ old('departement', $profile->departement) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Arrondissement --}}
        <div>
            <label for="arrondissement" class="block text-sm font-medium text-marron-fonce">Arrondissement</label>
            <input type="text" id="arrondissement" name="arrondissement" value="{{ old('arrondissement', $profile->arrondissement) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="telephone" class="block text-sm font-medium text-marron-fonce">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $profile->telephone) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Nombre d’enfants --}}
        <div>
            <label for="nombre_enfants" class="block text-sm font-medium text-marron-fonce">Nombre d’enfants</label>
            <input type="number" id="nombre_enfants" name="nombre_enfants" min="0"
                   value="{{ old('nombre_enfants', $profile->nombre_enfants) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Prénoms des enfants --}}
        <div>
            <label for="enfants" class="block text-sm font-medium text-marron-fonce">Prénoms des enfants</label>
            <input type="text" id="enfants" name="enfants" value="{{ old('enfants', $profile->enfants) }}"
                   placeholder="Exemple : Emma, Lucas"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Photo --}}
        <div>
            <label for="photo" class="block text-sm font-medium text-marron-fonce">Photo de la famille</label>
            <input type="file" id="photo" name="photo"
                   class="mt-1 block w-full text-sm text-sable file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-caramel file:text-white hover:file:bg-caramel-fonce">
            @if($profile->photo)
                <p class="mt-2">Photo actuelle :</p>
                <img src="{{ asset('storage/' . $profile->photo) }}" class="w-24 h-24 rounded-full object-cover shadow">
            @endif
        </div>

        {{-- Bouton --}}
        <div class="pt-4 flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-marron-fonce text-white rounded-md hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</main>
@endsection
