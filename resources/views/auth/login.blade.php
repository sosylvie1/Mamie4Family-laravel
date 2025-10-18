@extends('layouts.guest')

@section('title', 'Connexion | Mamie4Family')
@section('description', 'Connectez-vous à votre espace Mamie, Famille ou Administrateur.')

@section('content')
<main role="main" class="flex flex-col items-center justify-center min-h-screen bg-beige-pastel px-4">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center text-marron-fonce mb-6">🔐 Connexion</h1>

        {{-- 🔔 Messages de succès ou d’erreur --}}
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-300 text-red-600 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- 🧾 Formulaire de connexion --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-caramel focus:border-caramel"
                       required autofocus>
            </div>

            {{-- Mot de passe --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password"
                       class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-caramel focus:border-caramel"
                       required>
            </div>

            {{-- Sélecteur du rôle --}}
            @if(empty($role))
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Vous êtes</label>
                    <select id="role" name="role"
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-caramel focus:border-caramel" required>
                        <option value="famille" {{ old('role')=='famille' ? 'selected' : '' }}>👨‍👩‍👧 Une Famille</option>
                        <option value="mamie" {{ old('role')=='mamie' ? 'selected' : '' }}>👵 Une Mamie</option>
                        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>👩‍💼 Administrateur</option>
                    </select>
                </div>
            @else
                {{-- Si le rôle est déjà connu (URL ?role=...), on le masque --}}
                <input type="hidden" name="role" value="{{ $role }}">
                <p class="text-sm text-gray-700 mt-2 text-center">
                    @if($role === 'mamie') 👵 Vous accédez à l’espace <strong>Mamie</strong>.
                    @elseif($role === 'famille') 👨‍👩‍👧 Vous accédez à l’espace <strong>Famille</strong>.
                    @elseif($role === 'admin') 👩‍💼 Vous accédez à l’espace <strong>Administrateur</strong>.
                    @endif
                </p>
            @endif

            {{-- Bouton --}}
            <button type="submit"
                    class="w-full bg-caramel text-white font-semibold py-2 rounded hover:bg-caramel-pastel transition focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                Se connecter
            </button>
        </form>

        {{-- Lien mot de passe oublié --}}
        <p class="mt-4 text-center text-sm">
            <a href="{{ route('password.request') }}" class="text-caramel hover:underline">
                Mot de passe oublié ?
            </a>
        </p>

        {{-- Lien inscription --}}
        <p class="mt-2 text-center text-sm text-gray-700">
            Pas encore de compte ?
            <a href="{{ route('register.choice') }}"
               class="text-caramel font-semibold hover:underline focus-visible:ring-2 focus-visible:ring-caramel">
                🧾 Créer un compte
            </a>
        </p>
    </div>
</main>
@endsection
