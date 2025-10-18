@extends('layouts.admin')

@section('title', 'Mon profil administrateur | Mamie4Family')
@section('description', 'Espace administrateur — consultez vos informations personnelles.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-6">
        ⚙️ Mon profil administrateur
    </h1>

    {{-- ✅ Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- 🧾 Informations du profil --}}
    <dl class="divide-y divide-gray-200 text-gray-800">
        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Nom</dt>
            <dd>{{ $admin->name ?? 'Non renseigné' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Email</dt>
            <dd>{{ $admin->email ?? 'Non renseigné' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Téléphone</dt>
            <dd>{{ $profile->phone ?? 'Non renseigné' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Adresse</dt>
            <dd>{{ $profile->address ?? 'Non renseignée' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Ville</dt>
            <dd>{{ $profile->city ?? 'Non renseignée' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Code postal</dt>
            <dd>{{ $profile->postal_code ?? 'Non renseigné' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Département</dt>
            <dd>{{ $profile->department ?? 'Non renseigné' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Fonction</dt>
            <dd>{{ $profile->position ?? 'Non renseignée' }}</dd>
        </div>

        <div class="py-3 flex justify-between">
            <dt class="font-semibold">Rôle</dt>
            <dd class="capitalize">
                {{ $admin->role === 'admin' ? 'Administrateur' : ucfirst($admin->role) }}
            </dd>
        </div>
    </dl>

    {{-- 🎛 Boutons d’action --}}
    <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-400"
           aria-label="Retour au tableau de bord">
            ⬅ Retour
        </a>

        <a href="{{ route('admin.profile.edit') }}"
           class="inline-flex items-center px-4 py-2 bg-caramel text-white rounded-lg hover:bg-marron-fonce focus:ring-2 focus:ring-caramel-pastel"
           aria-label="Modifier le profil administrateur">
            ✏️ Modifier
        </a>
    </div>
</main>
@endsection
