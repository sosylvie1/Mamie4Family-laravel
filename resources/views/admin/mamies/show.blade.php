@extends('layouts.admin')

@section('title', 'Profil de ' . ($mamie->user->name ?? 'Mamie') . ' | Mamie4Family')
@section('description', 'Fiche détaillée du profil Mamie pour gestion par l’administrateur.')

@section('admin-content')
    <main role="main" class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">
        {{-- Bouton retour --}}
        <a href="{{ route('admin.mamies.index') }}"
            class="inline-block mb-6 text-caramel hover:underline focus:ring-2 focus:ring-caramel">
            ← Retour à la liste des Mamies
        </a>

        <section class="flex flex-col md:flex-row gap-6">
            {{-- Photo --}}
            <div class="md:w-1/3">
                @if ($mamie->photo)
                    <img src="{{ asset('storage/' . $mamie->photo) }}" alt="Photo de {{ $mamie->user->name }}"
                        class="w-full h-auto rounded-lg shadow">
                @else
                    <img src="{{ asset('images/default-mamie.jpg') }}" alt="Photo par défaut d’une mamie"
                        class="w-full h-auto rounded-lg shadow">
                @endif
            </div>

            {{-- Informations principales --}}
            <div class="md:w-2/3">
                <h1 class="text-2xl font-bold text-marron-fonce mb-2">
                    {{ $mamie->user->name ?? 'Mamie inconnue' }}
                </h1>

                {{-- 📞 Téléphone --}}
                <div>
                    <label for="telephone" class="block font-medium text-marron-fonce mb-1">Téléphone</label>
                    <input type="text" id="telephone" name="telephone"
                        value="{{ old('telephone', $mamie->telephone ?? '') }}" placeholder="Ex : 0601020304"
                        class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none">
                    <p class="text-sm text-gray-500 mt-1">Ce numéro reste confidentiel et n’est pas affiché publiquement.
                    </p>
                </div>
                <p class="text-gray-700 mb-2"><strong>📍 Ville :</strong> {{ $mamie->ville ?? '—' }}</p>
                <p class="text-gray-700 mb-2"><strong>🏙️ Département :</strong> {{ $mamie->departement ?? '—' }}</p>
                <p class="text-gray-700 mb-2"><strong>🏘️ Arrondissement :</strong> {{ $mamie->arrondissement ?? '—' }}</p>

                <p class="text-gray-700 mb-2"><strong>💬 Bio :</strong><br>{{ $mamie->bio ?? 'Aucune biographie fournie.' }}
                </p>
                <p class="text-gray-700 mb-2"><strong>🧹 Services :</strong> {{ $mamie->services ?? 'Non précisé' }}</p>
                <p class="text-gray-700 mb-2"><strong>💶 Tarif horaire net:</strong>
                    {{ $mamie->tarif ? $mamie->tarif . ' € / h' : 'Non précisé' }}
                </p>

                {{-- Carte d'identité --}}
                <div class="mt-4">
                    @if ($mamie->cni)
                        <p class="text-sm text-gray-700">
                            🪪 <strong>CNI disponible :</strong>
                            <a href="{{ route('admin.mamies.downloadCni', $mamie->id) }}"
                                class="text-blue-600 underline">Télécharger</a>
                        </p>
                    @else
                        <p class="text-sm text-gray-500">🪪 Aucune CNI fournie</p>
                    @endif
                </div>

                {{-- Boutons d’action --}}
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('admin.mamies.edit', $mamie->id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏️ Modifier</a>

                    <form action="{{ route('admin.mamies.destroy', $mamie->id) }}" method="POST"
                        onsubmit="return confirm('Supprimer ce profil ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
