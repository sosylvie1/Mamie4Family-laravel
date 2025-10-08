@extends('layouts.mamie')

@section('title', 'Mon profil | Mamie4Family')
@section('description', 'Consultez les informations de votre profil Mamie sur Mamie4Family.')

@section('mamie-content')
    <main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">

        {{-- 🔙 Bouton retour tableau de bord --}}
        <div class="mb-4">
            <a href="{{ route('mamie.dashboard') }}"
                class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
                ⬅ Retour au tableau de bord
            </a>
        </div>

        <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-4">👵 Mon profil</h1>

        {{-- ✅ Message succès --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center shadow-sm" role="status">
                {{ session('success') }}
            </div>
        @endif

        {{-- 📋 Informations de base --}}
        <section class="space-y-4 text-gray-800 leading-relaxed">
            <p><strong>👤 Nom :</strong> {{ $mamie->name }}</p>
            <p><strong>📧 Email :</strong> {{ $mamie->email }}</p>



            {{-- Téléphone : visible seulement pour admin, mamie, ou famille ayant déjà échangé --}}
            
                <p><strong>📞 Téléphone :</strong>
                @if ($canSeePhone)
                    {{ $profile->telephone ?? 'Non renseigné' }} </p>
                @else
                    <span class="text-gray-500">Privé (visible après premier échange de message)</span>
                @endif
            


            {{-- 📍 Adresse --}}
            <p><strong>📬 Adresse :</strong> {{ $profile->adresse ?? 'Non renseignée' }}</p>
            <p><strong>🏙 Ville :</strong> {{ $profile->ville ?? 'Non renseignée' }}</p>
            <p><strong>🏢 Département :</strong> {{ $profile->departement ?? 'Non renseigné' }}</p>
            <p><strong>🏡 Arrondissement :</strong> {{ $profile->arrondissement ?? 'Non renseigné' }}</p>

            {{-- 🧺 Services --}}
            <p><strong>🧺 Services proposés :</strong> {{ $profile->services ?? 'Non renseigné' }}</p>

            {{-- 💶 Tarif --}}
            <p><strong>💶 Tarif horaire net :</strong>
                @if ($profile->tarif)
                    {{ $profile->tarif }} € / heure
                @else
                    Non renseigné
                @endif
            </p>

            {{-- 💬 Biographie --}}
            <p><strong>💬 Biographie :</strong> {{ $profile->bio ?? 'Non renseignée' }}</p>

            {{-- 📸 Photo --}}
            @if ($profile->photo)
                <div>
                    <strong>📸 Photo :</strong>
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="Photo de profil de {{ $mamie->name }}"
                        class="mt-2 w-32 h-32 object-cover rounded-full shadow">
                </div>
            @else
                <p><strong>📸 Photo :</strong> Non fournie</p>
            @endif

            {{-- 🪪 CNI --}}
            @if ($profile->cni)
                <p><strong>🪪 Carte d’identité :</strong> ✅ Document fourni</p>
                <a href="{{ route('mamie.profile.cni.download') }}"
                    class="text-blue-600 underline hover:text-blue-800 focus:ring-2 focus:ring-caramel-fonce">
                    📎 Télécharger ma CNI
                </a>
            @else
                <p><strong>🪪 Carte d’identité :</strong> ❌ Non fournie</p>
            @endif
        </section>

        {{-- ✏️ Bouton modifier --}}
        <div class="mt-6 text-center">
            <a href="{{ route('mamie.profile.edit') }}"
                class="px-4 py-2 bg-caramel text-white rounded-md hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
                ✏️ Modifier mon profil
            </a>
        </div>
    </main>
@endsection
