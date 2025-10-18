@extends('layouts.app')

@section('title', 'Mot de passe oublié | Mamie4Family')
@section('description', 'Récupérez l’accès à votre compte Mamie4Family en demandant un lien de réinitialisation de mot de passe.')

@section('content')
<main role="main" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow mt-10">
    <h1 class="text-2xl font-bold mb-4 text-marron-fonce">🔐 Mot de passe oublié</h1>

    <p class="text-sm text-gray-700 mb-6">
        Indiquez simplement votre adresse e-mail, et nous vous enverrons un lien pour créer un nouveau mot de passe.
    </p>

    @if (session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-300 rounded text-green-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-3 mb-4 bg-red-100 border border-red-300 rounded text-red-700">
            ⚠️ {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email" class="block text-sm font-medium text-gray-800">Adresse e-mail</label>
        <input type="email" id="email" name="email" required
               class="w-full mt-2 mb-4 p-2 border rounded focus:ring-2 focus:ring-caramel outline-none"
               placeholder="ex: famille@exemple.fr">

        <button type="submit"
                class="w-full bg-caramel text-white py-2 rounded hover:bg-caramel-fonce focus:ring-2 focus:ring-offset-2 focus:ring-caramel-fonce">
            📩 Envoyer le lien de réinitialisation
        </button>
    </form>
</main>
@endsection
