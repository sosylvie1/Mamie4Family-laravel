@extends('layouts.app')

@section('title', 'Créer un compte | Mamie4Family')
@section('description', 'Choisissez le type de compte à créer : Famille ou Mamie.')
@if(session('error'))
    <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300" role="alert">
        ⚠️ {{ session('error') }}
    </div>
@endif
@section('content')
<main role="main" class="min-h-[80vh] flex items-center justify-center bg-sable px-4">
    <section class="w-full max-w-md bg-white border border-caramel-pastel shadow-lg rounded-2xl p-8 text-center">
        <h1 class="text-2xl font-bold text-marron-fonce mb-6">🧾 Créer un compte</h1>
        <p class="text-gray-700 mb-8">
            Sélectionnez votre profil pour continuer votre inscription sur <strong>Mamie4Family</strong>.
        </p>

        <a href="{{ route('familles.register') }}"
           class="block w-full bg-pink-600 text-white font-semibold py-3 mb-4 rounded-lg hover:bg-pink-700 focus:ring-2 focus:ring-pink-400 transition">
            👨‍👩‍👧 Je suis une Famille
        </a>

        <a href="{{ route('mamies.register') }}"
           class="block w-full bg-purple-600 text-white font-semibold py-3 rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-400 transition">
            👵 Je suis une Mamie
        </a>

        <p class="mt-8 text-sm text-gray-600">
            <a href="{{ route('login') }}" class="text-caramel hover:underline focus:ring-2 focus:ring-caramel">
                🔑 Déjà un compte ? Se connecter
            </a>
        </p>
    </section>
</main>
@endsection
