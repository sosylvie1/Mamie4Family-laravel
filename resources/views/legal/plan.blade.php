@extends('layouts.app')

@section('title', 'Plan du site | Mamie4Family')
@section('description', 'Consultez la structure complète du site Mamie4Family pour naviguer facilement entre les pages.')

{{-- @section('header')
    🗺️ Plan du site
@endsection --}}

@section('content')
<article class="max-w-3xl mx-auto prose text-marron-fonce">
    <h1>🗺️ Plan du site</h1>
    <p>Voici la liste complète des pages et sections du site <strong>Mamie4Family</strong> :</p>

    <h2>Pages publiques</h2>
    <ul>
        <li><a href="{{ route('welcome') }}" class="underline text-caramel-fonce">🏠 Accueil</a></li>
        <li><a href="{{ route('mamies.index') }}" class="underline text-caramel-fonce">👵 Catalogue des Mamies</a></li>
        <li><a href="{{ route('contact') }}" class="underline text-caramel-fonce">📞 Contactez-nous</a></li>
    </ul>

    <h2>Espace Famille</h2>
    <ul>
        <li><a href="{{ route('famille.dashboard') }}" class="underline text-caramel-fonce">📊 Tableau de bord</a></li>
        <li><a href="{{ route('famille.profile.edit') }}" class="underline text-caramel-fonce">👤 Mon profil</a></li>
        <li><a href="{{ route('famille.messages.index') }}" class="underline text-caramel-fonce">💬 Messages</a></li>
    </ul>

    <h2>Espace Mamie</h2>
    <ul>
        <li><a href="{{ route('mamie.dashboard') }}" class="underline text-caramel-fonce">📊 Tableau de bord</a></li>
        <li><a href="{{ route('mamie.profile.show') }}" class="underline text-caramel-fonce">👵 Mon profil</a></li>
        <li><a href="{{ route('mamie.messages.index') }}" class="underline text-caramel-fonce">💌 Messages</a></li>
    </ul>

    <h2>Espace Admin</h2>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}" class="underline text-caramel-fonce">🛠 Dashboard</a></li>
        <li><a href="{{ route('admin.familles.index') }}" class="underline text-caramel-fonce">👨‍👩‍👧 Familles</a></li>
        <li><a href="{{ route('admin.mamies.index') }}" class="underline text-caramel-fonce">👵 Mamies</a></li>
        <li><a href="{{ route('admin.messages.index') }}" class="underline text-caramel-fonce">💬 Messages</a></li>
    </ul>

    <h2>Pages légales</h2>
    <ul>
        <li><a href="{{ route('cgu') }}" class="underline text-caramel-fonce">📝 Conditions Générales d’Utilisation</a></li>
        <li><a href="{{ route('confidentialite') }}" class="underline text-caramel-fonce">🔒 Politique de Confidentialité</a></li>
    </ul>

    <p class="mt-6 italic text-sm">Dernière mise à jour : {{ date('d/m/Y') }}</p>
</article>
@endsection
