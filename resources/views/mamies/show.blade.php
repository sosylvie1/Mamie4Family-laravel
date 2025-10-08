@extends('layouts.app')

@section('title', 'Profil de ' . ($mamie->user->name ?? 'Mamie') . ' | Mamie4Family')
@section('description', 'Découvrez le profil complet de ' . ($mamie->user->name ?? 'cette mamie') . ' sur Mamie4Family.')

@section('content')
<main role="main" aria-labelledby="page-title" class="max-w-4xl mx-auto p-6">
@if (session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded text-center shadow-sm" role="alert">
        {{ session('success') }}
    </div>
@endif

    {{-- 🔙 Bouton retour --}}
    <nav role="navigation" class="mb-6 flex justify-start space-x-3">
        <a href="{{ route('mamies.index') }}"
           class="inline-block px-4 py-2 bg-gray-200 text-marron-fonce rounded hover:bg-gray-300 focus:ring-2 focus:ring-caramel-fonce">
            ⬅ Retour au catalogue
        </a>

        {{-- 🔙 Bouton retour au tableau de bord (famille connectée uniquement) --}}
        @auth
            @if(auth()->user()->isFamille())
                <a href="{{ route('famille.dashboard') }}"
                   class="inline-block px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-caramel-fonce">
                    🏠 Retour au tableau de bord
                </a>
            @endif
        @endauth
    </nav>

    {{-- 🧓 Section profil --}}
    <section class="bg-white shadow-md rounded-lg p-6 border border-caramel-pastel">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- 📸 Photo --}}
            <div class="flex-shrink-0">
                <img src="{{ $mamie->photo ? asset('storage/' . $mamie->photo) : asset('images/default-mamie.png') }}"
                     alt="Photo de {{ $mamie->user->name }}"
                     class="w-48 h-48 rounded-full object-cover border-4 border-caramel-pastel shadow-md mx-auto md:mx-0">
            </div>

            {{-- 🧾 Informations principales --}}
            <div class="flex-1">
                <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-2">
                    {{ $mamie->user->name }}
                </h1>

                {{-- Localisation --}}
                <p class="text-gray-700 mb-1">
                    📍 <strong>Ville :</strong> {{ $mamie->ville ?? 'Non renseignée' }}
                </p>
                @if($mamie->departement)
                    <p class="text-gray-700 mb-1">🏙️ <strong>Département :</strong> {{ $mamie->departement }}</p>
                @endif
                @if($mamie->arrondissement)
                    <p class="text-gray-700 mb-1">🏡 <strong>Arrondissement :</strong> {{ $mamie->arrondissement }}</p>
                @endif
                @if($mamie->adresse)
                    <p class="text-gray-700 mb-1">📬 <strong>Adresse :</strong> {{ $mamie->adresse }}</p>
                @endif

                {{-- Services --}}
                <p class="text-gray-700 mt-3">
                    🧺 <strong>Services proposés :</strong><br>
                    {{ $mamie->services ?? 'Non renseignés' }}
                </p>

                {{-- Tarif --}}
                <p class="text-gray-700 mt-2">
                    💶 <strong>Tarif horaire net :</strong> 
                    @if($mamie->tarif)
                        {{ $mamie->tarif }} € / heure
                    @else
                        Non renseigné
                    @endif
                </p> <br>
                <p class="text-gray-500 italic">📞<strong> Téléphone :</strong>  Contact disponible après échange de messages.</p>

            </div>
        </div>

        {{-- 💬 Biographie --}}
        <div class="mt-6 border-t border-caramel-pastel pt-4">
            <h2 class="text-xl font-semibold text-marron-fonce mb-2">💬 À propos</h2>
            <p class="text-gray-800 leading-relaxed">
                {{ $mamie->bio ?? 'Aucune biographie renseignée pour le moment.' }}
            </p>
        </div>
    </section>

    {{-- 📞 Contact ou message --}}
    <section class="mt-8 bg-caramel/10 rounded-lg p-6">
        <h2 class="text-xl font-semibold text-marron-fonce mb-4 text-center">👋 Contacter cette Mamie</h2>

        @auth
            @if(auth()->user()->isFamille())
                {{-- ✅ Formulaire visible uniquement pour les familles connectées --}}
                <form method="POST" action="{{ route('famille.messages.store') }}" class="space-y-4 max-w-xl mx-auto">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $mamie->user->id }}">

                    <div>
                        <label for="message" class="block text-marron-fonce font-medium mb-1">Votre message :</label>
                        <textarea name="message" id="message" rows="4"
                                  class="w-full border border-caramel rounded-md p-2 focus:ring-2 focus:ring-caramel outline-none"
                                  placeholder="Écrivez un message à cette mamie..." required></textarea>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
                        ✉️ Envoyer le message
                    </button>
                </form>
            @else
                {{-- 🔒 Connecté mais pas famille --}}
                <p class="text-center text-marron-fonce">
                    ⚠️ Seules les familles peuvent envoyer un message à une mamie.
                </p>
            @endif
        @else
            {{-- 🔐 Non connecté --}}
            <div class="text-center">
                <p class="text-gray-700 mb-4">
                    Vous devez être connecté en tant que <strong>famille</strong> pour lui envoyer un message.
                </p>
                <a href="{{ route('login') }}"
                   class="inline-block px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-caramel-fonce">
                    🔐 Se connecter
                </a>
            </div>
        @endauth
    </section>
</main>
@endsection
