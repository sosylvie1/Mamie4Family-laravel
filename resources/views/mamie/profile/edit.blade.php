@extends('layouts.mamie')

@section('title', 'Modifier mon profil | Mamie4Family')
@section('description', 'Espace Mamie : mettez à jour vos informations personnelles, vos services et vos coordonnées de contact (téléphone non public).')

@section('mamie-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">

    {{-- ✅ Message succès --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- ⚠️ Erreurs de validation --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 🔙 Bouton retour au dashboard --}}
    <div class="mb-4">
        <a href="{{ route('mamie.dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
            ⬅ Retour au tableau de bord
        </a>
    </div>

    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-6">✏️ Modifier mon profil</h1>

    {{-- Formulaire de mise à jour --}}
    <form action="{{ route('mamie.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- 📞 Téléphone (non public) --}}
        <div>
            <label for="telephone" class="block text-marron-fonce font-medium mb-1">Téléphone</label>
            <input type="text" id="telephone" name="telephone"
                   value="{{ old('telephone', $mamie->telephone ?? '') }}"
                   placeholder="Ex : 0601020304"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
            <p class="text-sm text-gray-500 mt-1">Ce numéro est confidentiel et uniquement visible par vous et l’administrateur.</p>
        </div>

        {{-- 📬 Adresse --}}
        <div>
            <label for="adresse" class="block text-marron-fonce font-medium mb-1">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $profile->adresse) }}"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
        </div>

        {{-- 📍 Ville --}}
        <div>
            <label for="ville" class="block text-marron-fonce font-medium mb-1">Ville</label>
            <input type="text" id="ville" name="ville" value="{{ old('ville', $profile->ville) }}"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
        </div>

        {{-- 🏙 Département --}}
        <div>
            <label for="departement" class="block text-marron-fonce font-medium mb-1">Département</label>
            <input type="text" id="departement" name="departement" value="{{ old('departement', $profile->departement) }}"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
        </div>

        {{-- 🏡 Arrondissement --}}
        <div>
            <label for="arrondissement" class="block text-marron-fonce font-medium mb-1">Arrondissement</label>
            <input type="text" id="arrondissement" name="arrondissement" value="{{ old('arrondissement', $profile->arrondissement) }}"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
        </div>

        {{-- 🧺 Services --}}
        <div>
            <label for="services" class="block text-marron-fonce font-medium mb-1">Services proposés</label>
            <textarea id="services" name="services" rows="3"
                      class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none"
                      placeholder="Ex : garde d’enfants, aide aux devoirs, accompagnement, cuisine...">{{ old('services', $profile->services) }}</textarea>
        </div>

        {{-- 💶 Tarif horaire --}}
        <div>
            <label for="tarif" class="block text-marron-fonce font-medium mb-1">Tarif horaire net (€)</label>
            <input type="number" step="0.01" id="tarif" name="tarif" value="{{ old('tarif', $profile->tarif) }}"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
        </div>

        {{-- 💬 Biographie --}}
        <div>
            <label for="bio" class="block text-marron-fonce font-medium mb-1">Biographie</label>
            <textarea id="bio" name="bio" rows="4"
                      class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none"
                      placeholder="Parlez un peu de vous, de vos expériences, de votre personnalité...">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        {{-- 📸 Photo --}}
        <div>
            <label for="photo" class="block text-marron-fonce font-medium mb-1">Photo de profil</label>
            <input type="file" id="photo" name="photo" accept="image/*"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none bg-white">
            @if($profile->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="Photo actuelle"
                         class="w-24 h-24 rounded-full object-cover shadow">
                    <p class="text-sm text-gray-500 mt-1">Photo actuelle</p>
                </div>
            @endif
        </div>

        {{-- 🪪 CNI --}}
        <div>
            <label for="cni" class="block text-marron-fonce font-medium mb-1">Carte d’identité (jpeg, png, pdf)</label>
            <input type="file" id="cni" name="cni"
                   class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none bg-white">
            @if($profile->cni)
                <p class="mt-2 text-green-600 text-sm">CNI déjà déposée ✅</p>
            @endif
        </div>

        {{-- 💾 Bouton --}}
        <div class="pt-4 flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</main>
@endsection
