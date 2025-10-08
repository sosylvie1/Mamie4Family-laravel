@extends('layouts.app')

@section('title', 'Connexion Administrateur')
@section('description', 'Connectez-vous en tant qu’administrateur pour gérer la plateforme Mamie4Family.')

@section('content')
<main role="main" class="max-w-lg mx-auto mt-10 p-6 bg-white shadow rounded border border-red-200">
    <h1 class="text-2xl font-bold mb-4 text-red-700">Connexion Administrateur</h1>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-red-400"
                   required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-red-400"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition">
            Se connecter
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-500">
        ⚠️ Cet espace est réservé aux administrateurs de Mamie4Family.
    </p>
</main>
@endsection
