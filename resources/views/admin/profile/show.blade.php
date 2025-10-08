@extends('layouts.admin')

@section('title', 'Mon Profil Admin | Mamie4Family')
@section('description', 'Espace administrateur — consultez vos informations personnelles.')

@section('admin-content')
<main class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">⚙️ Mon Profil Administrateur</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 space-y-3">
        <p><strong>Nom :</strong> {{ $admin->name }}</p>
        <p><strong>Email :</strong> {{ $admin->email }}</p>
        <p><strong>Téléphone :</strong> {{ $profile->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Adresse :</strong> {{ $profile->adresse ?? 'Non renseignée' }}</p>
        <p><strong>Département :</strong> {{ $profile->departement ?? 'Non renseigné' }}</p>
        <p><strong>Fonction :</strong> {{ $profile->fonction ?? 'Non renseignée' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.profile.edit') }}" class="bg-caramel text-white px-4 py-2 rounded hover:bg-caramel-fonce">
            ✏️ Modifier mes informations
        </a>
    </div>
</main>
@endsection
