@extends('layouts.admin')

@section('title', 'Modifier mon profil administrateur | Mamie4Family')
@section('description', 'Page de mise à jour du profil de l’administrateur du site Mamie4Family.')

@section('admin-content')
<main role="main" aria-labelledby="page-title"
      class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6 mt-8">

    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-6">
        ✏️ Modifier mon profil administrateur
    </h1>

    {{-- ✅ Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg"
             role="alert" aria-live="polite">
            {{ session('success') }}
        </div>
    @endif

    {{-- ⚠️ Affichage des erreurs --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg"
             role="alert" aria-live="assertive">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 🧾 Formulaire de mise à jour --}}
    <form id="edit-form"
          action="{{ route('admin.profile.update') }}"
          method="POST"
          class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-marron-fonce">Nom</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $admin->name) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-marron-fonce">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $admin->email) }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-marron-fonce">Téléphone</label>
            <input type="text" id="phone" name="phone"
                   value="{{ old('phone', $profile->phone ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Adresse --}}
        <div>
            <label for="address" class="block text-sm font-medium text-marron-fonce">Adresse</label>
            <input type="text" id="address" name="address"
                   value="{{ old('address', $profile->address ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Ville --}}
        <div>
            <label for="city" class="block text-sm font-medium text-marron-fonce">Ville</label>
            <input type="text" id="city" name="city"
                   value="{{ old('city', $profile->city ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Code postal --}}
        <div>
            <label for="postal_code" class="block text-sm font-medium text-marron-fonce">Code postal</label>
            <input type="text" id="postal_code" name="postal_code"
                   value="{{ old('postal_code', $profile->postal_code ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Département --}}
        <div>
            <label for="department" class="block text-sm font-medium text-marron-fonce">Département</label>
            <input type="text" id="department" name="department"
                   value="{{ old('department', $profile->department ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Fonction --}}
        <div>
            <label for="position" class="block text-sm font-medium text-marron-fonce">Fonction</label>
            <input type="text" id="position" name="position"
                   value="{{ old('position', $profile->position ?? '') }}"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Nouveau mot de passe --}}
        <div>
            <label for="password" class="block text-sm font-medium text-marron-fonce">
                Nouveau mot de passe <span class="text-gray-500 text-xs">(optionnel)</span>
            </label>
            <input type="password" id="password" name="password"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- Confirmation mot de passe --}}
        <div>
            <label for="password_confirmation"
                   class="block text-sm font-medium text-marron-fonce">
                Confirmer le mot de passe
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="mt-1 block w-full rounded-md border-caramel-pastel shadow-sm
                          focus:border-caramel focus:ring focus:ring-caramel sm:text-sm">
        </div>

        {{-- 🎛 Boutons d’action --}}
        <div class="pt-4 flex justify-between items-center">
            {{-- Bouton annuler --}}
            <a href="{{ route('admin.profile.show') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md
                      hover:bg-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
               aria-label="Annuler la modification du profil">
                ⬅ Annuler
            </a>

            <div class="flex gap-3">
                {{-- Supprimer le profil --}}
                <form action="{{ route('admin.profile.destroy') }}" method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment supprimer toutes les informations de votre profil ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"
                            aria-label="Supprimer les informations du profil administrateur">
                        🗑️ Supprimer
                    </button>
                    @csrf
@method('PUT')
<input type="hidden" name="_debug" value="1">

                </form>

                {{-- Enregistrer --}}
                <button type="submit"
                        class="px-4 py-2 bg-caramel text-white rounded-md hover:bg-marron-fonce
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel"
                        aria-label="Enregistrer les modifications du profil administrateur">
                    💾 Enregistrer
                </button>
            </div>
        </div>
    </form>
</main>
@endsection
