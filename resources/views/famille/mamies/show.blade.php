@extends('layouts.famille')

@section('title', 'Profil de ' . ($mamie->name ?? 'Mamie') . ' | Mamie4Family')
@section('description', 'Découvrez les informations détaillées de ' . ($mamie->name ?? 'cette mamie') . ' sur Mamie4Family.')

@section('famille-content')
<main role="main" aria-labelledby="page-title" class="max-w-5xl mx-auto px-6 py-10">
    {{-- Titre principal --}}
    <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-6 flex items-center gap-2">
        👵 Profil de {{ $mamie->name }}
    </h1>

    {{-- Bouton retour --}}
    <a href="{{ route('famille.mamies.index') }}"
       class="inline-flex items-center gap-2 mb-6 text-sm text-blue-900 font-medium hover:underline focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none">
        ⬅ Retour à l’annuaire
    </a>

    {{-- Carte du profil --}}
    <section class="bg-white shadow-md rounded-2xl border border-caramel-pastel p-8 grid md:grid-cols-2 gap-8" role="region" aria-label="Profil Mamie">
        @php
    // On vérifie plusieurs sources possibles pour la photo
    $photoPath = $mamie->mamieProfile->photo
        ?? $mamie->profile_photo_path
        ?? null;

    if ($photoPath) {
        // Si le chemin existe dans le storage Laravel
        $photoUrl = \Illuminate\Support\Facades\Storage::url($photoPath);
    } else {
        // Sinon image par défaut
        $photoUrl = asset('images/default-mamie.webp');
    }
@endphp

<img src="{{ $photoUrl }}"
     alt="Photo de {{ $mamie->name }}"
     class="w-48 h-48 object-cover rounded-full shadow-md border-4 border-caramel-pastel mb-4"
     width="300" height="300" loading="lazy">


        {{-- Informations détaillées --}}
        <div class="space-y-3 text-gray-800 leading-relaxed">
            
            <p><span class="font-semibold">📍 Ville :</span> {{ $mamie->mamieProfile->ville ?? '—' }}</p>
            <p><span class="font-semibold">🏠 Département :</span> {{ $mamie->mamieProfile->departement ?? '—' }}</p>
            <p><span class="font-semibold">🏘️ Arrondissement :</span> {{ $mamie->mamieProfile->arrondissement ?? '—' }}</p>
            <p><span class="font-semibold">👜 Services :</span> {{ $mamie->mamieProfile->services ?? '—' }}</p>
            <p><span class="font-semibold">💶 Tarif horaire :</span> {{ $mamie->mamieProfile->tarif ?? 'Non indiqué' }} € / heure</p>
            <p><span class="font-semibold">📚 Biographie :</span></p>
            <div class="bg-caramel-pastel/30 p-3 rounded-md text-marron-fonce">
                {{ $mamie->mamieProfile->bio ?? 'Cette mamie n’a pas encore ajouté de biographie.' }}
            </div>

            {{-- ✅ Téléphone visible uniquement si la famille a déjà contacté cette mamie --}}
            @php
                $famille = Auth::user();
                $aContacte = \App\Models\Message::where('sender_id', $famille->id)
                    ->where('receiver_id', $mamie->id)
                    ->exists();
            @endphp

            @if($aContacte)
                <p class="mt-4 text-green-700 font-semibold">
                    📞 Téléphone : {{ $mamie->mamieProfile->telephone ?? 'Non renseigné' }}
                </p>
            @else
                <p class="mt-4 text-gray-500 italic">
                    📞 Téléphone disponible après contact avec cette mamie.
                </p>
            @endif
        </div>
    </section>

    {{-- Bouton de contact --}}
    <div class="text-center mt-8">
        <a href="{{ route('famille.messages.create', ['receiver_id' => $mamie->id]) }}"
           class="px-6 py-3 bg-caramel text-white rounded-lg font-semibold hover:bg-caramel-fonce transition focus-visible:ring-2 focus-visible:ring-caramel focus:outline-none"
           aria-label="Contacter {{ $mamie->name }}">
           ✉️ Contacter {{ $mamie->name }}
        </a>
    </div>
</main>
@endsection
