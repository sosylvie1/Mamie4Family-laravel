@extends('layouts.app')

@section('title', 'Connexion')
@section('description', 'Connectez-vous pour accéder à votre espace Mamie4Family (Famille, Mamie ou Admin).')

@section('content')
<main role="main" class="max-w-lg mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>

    {{-- Message flash si erreur --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Adresse email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Adresse email</label>
            <input type="email" id="email" name="email"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-caramel"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-caramel"
                   required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Sélecteur du type d’utilisateur (optionnel) --}}
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium">Vous êtes</label>
            <select id="role" name="role"
                    class="w-full border rounded p-2 focus:outline-none focus:ring focus:ring-caramel" required>
                <option value="famille" {{ old('role')=='famille' ? 'selected' : '' }}>👨‍👩‍👧 Une Famille</option>
                <option value="mamie" {{ old('role')=='mamie' ? 'selected' : '' }}>👵 Une Mamie</option>
                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>🛠️ Administrateur</option>
            </select>
            @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bouton --}}
        <button type="submit"
                class="w-full bg-caramel text-white py-2 px-4 rounded hover:bg-caramel-pastel transition">
            Se connecter
        </button>
    </form>

    {{-- Lien mot de passe oublié --}}
    <p class="mt-4 text-center text-sm">
        <a href="{{ route('password.request') }}" class="text-caramel hover:underline">Mot de passe oublié ?</a>
    </p>

    {{-- Lien inscription --}}
    <p class="mt-2 text-center text-sm">
        {{-- Pas encore de compte ?  --}}
        {{-- <a href="{{ route('familles.register') }}" class="text-caramel hover:underline">Créer un compte Famille</a> ou 
        <a href="{{ route('mamies.register') }}" class="text-caramel hover:underline">Créer un compte Mamie</a> --}}
        <p class="mt-4 text-center text-sm text-gray-700">
    Pas encore de compte ?  
    <a href="{{ route('register.choice') }}" 
       class="text-caramel hover:underline font-semibold focus-visible:ring-2 focus-visible:ring-caramel">
        🧾 Créer un compte
    </a>
</p>

    </p>
</main>
@endsection
