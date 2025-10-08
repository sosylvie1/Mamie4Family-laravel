@extends('layouts.admin')

@section('title', 'Modifier mon profil | Admin')
@section('description', 'Formulaire de mise à jour du profil administrateur.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-4">✏️ Modifier mon profil</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Affichage erreurs --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-marron-fonce">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-marron-fonce">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-marron-fonce">Téléphone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Adresse --}}
        <div>
            <label for="address" class="block text-sm font-medium text-marron-fonce">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address', $admin->address) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Mot de passe --}}
        <div>
            <label for="password" class="block text-sm font-medium text-marron-fonce">Nouveau mot de passe (optionnel)</label>
            <input type="password" id="password" name="password"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Confirmation mot de passe --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-marron-fonce">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Bouton --}}
        <div class="pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-marron-fonce text-white rounded-md hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</main>
@endsection
