@extends('layouts.admin')

@section('title', "Modifier le profil de " . ($mamie->user->name ?? '—') . " | Mamie4Family")
@section('description', "Modification du profil de la mamie " . ($mamie->user->name ?? '—'))

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto">
    <h1 id="page-title" class="text-2xl font-bold mb-6 text-marron-fonce">✏️ Modifier le Profil Mamie</h1>

    <form action="{{ route('admin.mamies.update', $mamie) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        {{-- Bio --}}
        <div>
            <label for="bio" class="block font-medium">Biographie</label>
            <textarea id="bio" name="bio" rows="4" class="w-full border rounded">{{ old('bio', $mamie->bio) }}</textarea>
        </div>

        {{-- Localisation --}}
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label for="ville" class="block font-medium">Ville</label>
                <input id="ville" name="ville" type="text" value="{{ old('ville', $mamie->ville) }}" class="w-full border rounded">
            </div>
            <div>
                <label for="departement" class="block font-medium">Département</label>
                <input id="departement" name="departement" type="text" value="{{ old('departement', $mamie->departement) }}" class="w-full border rounded">
            </div>
            <div>
                <label for="arrondissement" class="block font-medium">Arrondissement</label>
                <input id="arrondissement" name="arrondissement" type="text" value="{{ old('arrondissement', $mamie->arrondissement) }}" class="w-full border rounded">
            </div>
        </div>

        {{-- Services et tarif --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="services" class="block font-medium">Services proposés</label>
                <input id="services" name="services" type="text" value="{{ old('services', $mamie->services) }}" class="w-full border rounded">
            </div>
            <div>
                <label for="tarif" class="block font-medium">Tarif net (€ / h)</label>
                <input id="tarif" name="tarif" type="number" step="0.01" value="{{ old('tarif', $mamie->tarif) }}" class="w-full border rounded">
            </div>
        </div>

        {{-- Photo --}}
        <div>
            <label for="photo" class="block font-medium">Photo de profil</label>
            <input id="photo" type="file" name="photo" class="w-full border rounded">
            @if($mamie->photo)
                <p class="mt-2 text-sm">📷 Photo actuelle :</p>
                <img src="{{ asset('storage/' . $mamie->photo) }}" class="w-32 h-32 rounded object-cover mt-1">
            @endif
        </div>

        {{-- CNI --}}
        <div>
            <label for="cni" class="block font-medium">Carte d’identité</label>
            <input id="cni" type="file" name="cni" class="w-full border rounded">
            @if($mamie->cni)
                <p class="mt-2 text-sm">🪪 CNI actuelle :
                    <a href="{{ route('admin.mamies.downloadCni', $mamie->id) }}" class="text-blue-600 underline">Télécharger</a>
                </p>
            @endif
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('admin.mamies.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">⬅ Retour</a>
            <button type="submit" class="px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-pastel">💾 Sauvegarder</button>
        </div>
    </form>
</main>
@endsection
