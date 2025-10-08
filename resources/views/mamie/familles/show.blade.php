@extends('layouts.mamie')

@section('title', "Profil de la famille " . ($famille->name ?? '—') . " | Mamie4Family")
@section('description', "Profil détaillé de la famille " . ($famille->name ?? '—') . " sur Mamie4Family.")

@section('mamie-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
    <h1 id="page-title" class="text-3xl font-bold text-marron-fonce flex items-center gap-2">
        👨‍👩‍👧 Profil de la famille {{ $famille->name }}
    </h1>

    <a href="{{ route('mamie.familles.index') }}"
       class="inline-flex items-center text-sm text-caramel hover:underline focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none rounded">
        ⬅ Retour à l’annuaire
    </a>

    {{-- 🏡 Carte profil famille --}}
    <section role="region" aria-labelledby="famille-profil"
             class="bg-white p-6 rounded-xl shadow border border-caramel-pastel">
        <h2 id="famille-profil" class="sr-only">Profil de la famille {{ $famille->name }}</h2>

        {{-- 📸 Photo famille --}}
        @if($famille->familleProfile && $famille->familleProfile->photo)
            <figure class="mb-6">
                <img src="{{ asset('storage/' . $famille->familleProfile->photo) }}"
                     alt="Photo de la famille {{ $famille->name }}"
                     class="w-full max-h-64 object-cover rounded-xl shadow-md border border-caramel-pastel">
                <figcaption class="sr-only">Photo de la famille {{ $famille->name }}</figcaption>
            </figure>
        @endif

        {{-- 🧾 Informations principales --}}
        <ul class="space-y-2 text-gray-800 leading-relaxed">
            <li><strong>👨‍👩‍👧 Nom :</strong> {{ $famille->name ?? 'Non renseigné' }}</li>
            <li><strong>📧 Email :</strong> {{ $famille->email ?? 'Non renseigné' }}</li>
            <li><strong>📍 Adresse :</strong> {{ $famille->familleProfile->adresse ?? 'Non renseignée' }}</li>
            <li><strong>🏙 Ville :</strong> {{ $famille->familleProfile->ville ?? 'Non renseignée' }}</li>
            <li><strong>🏘 Arrondissement :</strong> {{ $famille->familleProfile->arrondissement ?? 'Non renseigné' }}</li>
            <li><strong>🏞 Département :</strong> {{ $famille->familleProfile->departement ?? 'Non renseigné' }}</li>
            <li><strong>📞 Téléphone :</strong> {{ $famille->familleProfile->telephone ?? 'Non renseigné' }}</li>
            <li><strong>👶 Nombre d’enfants :</strong> {{ $famille->familleProfile->nombre_enfants ?? 'Non renseigné' }}</li>
            <li><strong>📋 Détails enfants :</strong> {{ $famille->familleProfile->enfants ?? 'Non renseignés' }}</li>
        </ul>

        {{-- 🕒 Infos de suivi optionnelles --}}
        <div class="text-xs text-gray-500 mt-4">
            <p>Membre depuis : {{ $famille->created_at->format('d/m/Y H:i') }}</p>
            <p>Dernière mise à jour : {{ $famille->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        {{-- ✉️ Bouton contact --}}
        <div class="mt-6 flex justify-end">
            <a href="{{ route('mamie.messages.create', ['receiver_id' => $famille->id]) }}"
               class="inline-flex items-center gap-2 bg-caramel text-white font-medium px-4 py-2 rounded-lg hover:bg-caramel-fonce focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none transition">
                📩 Contacter cette famille
            </a>
        </div>
    </section>
</main>
@endsection
