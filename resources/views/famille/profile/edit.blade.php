@extends('layouts.famille')

@section('title', 'Modifier mon profil famille | Mamie4Family')
@section('description', 'Page de modification du profil famille sur Mamie4Family.')

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6 mt-6">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-4">✏️ Modifier mon profil Famille</h1>

    {{-- ✅ Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- ✅ Formulaire principal du profil --}}
    <form action="{{ route('famille.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Adresse --}}
        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $profile->adresse) }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Ville + Code postal --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                <input type="text" name="ville" id="ville" value="{{ old('ville', $profile->ville) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
            </div>
            <div>
                <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal</label>
                <input type="text" name="code_postal" id="code_postal" value="{{ old('code_postal', $profile->code_postal) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
            </div>
        </div>

        {{-- Département --}}
        <div>
            <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
            <input type="text" name="departement" id="departement" value="{{ old('departement', $profile->departement) }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Arrondissement --}}
        <div>
            <label for="arrondissement" class="block text-sm font-medium text-gray-700">Arrondissement</label>
            <input type="text" name="arrondissement" id="arrondissement" value="{{ old('arrondissement', $profile->arrondissement) }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $profile->telephone) }}"
                class="mt-1 block w-full border-gray-300 rounded-md focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Photo --}}
        <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo de profil</label>
            @if($profile->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="Photo de la famille"
                        class="h-24 rounded-lg shadow-sm object-cover">
                </div>
            @endif
            <input type="file" name="photo" id="photo" accept="image/*"
                class="mt-2 block w-full text-sm border-gray-300 rounded-md cursor-pointer focus:ring-caramel focus:border-caramel">
        </div>

        {{-- Bouton enregistrer --}}
        <div class="pt-4 flex justify-end">
            <button type="submit"
                class="bg-marron-fonce text-white px-6 py-2 rounded-lg hover:bg-caramel focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>

    {{-- 🚸 Bloc Enfants --}}
<fieldset class="mt-10 border-t border-gray-300 pt-4" id="add">
    <legend class="text-lg font-semibold text-marron-fonce flex items-center gap-2">
        👶 Enfants (nom et âge)
    </legend>

    {{-- Liste des enfants existants --}}
    <div class="mt-3 space-y-3">
        @forelse($profile->enfants as $enfant)
            <div class="flex justify-between items-center border p-2 rounded-md bg-gray-50">
                <div>
                    <span class="font-medium text-gray-800">{{ $enfant->nom }}</span>
                    <span class="text-gray-500">({{ $enfant->age }} ans)</span>
                </div>
                <form action="{{ route('famille.enfant.delete', $enfant->id) }}" method="POST"
                      onsubmit="return confirm('Supprimer cet enfant ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 focus:ring-2 focus:ring-red-400">
                        🗑
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">Aucun enfant enregistré pour le moment.</p>
        @endforelse
    </div>

    {{-- ➕ Formulaire pour ajouter un enfant --}}
    <form action="{{ route('famille.enfant.store') }}" method="POST" class="mt-6 flex flex-wrap items-end gap-3">
        @csrf
        <div class="flex flex-col">
            <label for="nom" class="text-sm text-gray-700">Nom</label>
            <input type="text" id="nom" name="nom" required
                class="border rounded-md p-2 focus:ring-caramel focus:border-caramel" placeholder="Prénom">
        </div>
        <div class="flex flex-col">
            <label for="age" class="text-sm text-gray-700">Âge</label>
            <input type="number" id="age" name="age"
                class="border rounded-md p-2 w-24 focus:ring-caramel focus:border-caramel" placeholder="Âge">
        </div>
        <button type="submit"
            class="bg-caramel text-white px-4 py-2 rounded hover:bg-caramel-pastel focus:ring-2 focus:ring-caramel">
            ➕ Ajouter un enfant
        </button>
    </form>
</fieldset>

</main>
@endsection
