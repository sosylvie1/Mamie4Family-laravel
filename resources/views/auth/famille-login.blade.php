@extends('layouts.app')

@section('title', 'Connexion Famille')
@section('description', 'Connectez-vous pour accéder à votre espace famille sur Mamie4Family.')

@section('content')
<main role="main" class="max-w-lg mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Connexion Famille</h1>

    <form method="POST" action="{{ route('familles.login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-caramel"
                   required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-caramel"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-caramel text-white py-2 px-4 rounded hover:bg-caramel-pastel transition">
            Se connecter
        </button>
    </form>

    <p class="mt-4 text-center text-sm">
        Pas encore inscrit ? 
        <a href="{{ route('familles.register') }}" class="text-caramel hover:underline">Créer un compte famille</a>
    </p>
</main>
@endsection
