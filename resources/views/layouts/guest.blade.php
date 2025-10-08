<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO : Titre exact --}}
    <title>{{ config('app.name', 'Mamie4Family — Annuaire relationnel entre familles et mamies') }}</title>

    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-sable text-marron-fonce">

    {{-- NAVIGATION PUBLIQUE --}}
    @include('layouts.navigation')

    {{-- {{-- CONTENU --sans utiliser jetstream}} --}}
        <main role="main" class="py-6">
        @yield('content')
    </main>

    {{-- FOOTER GLOBAL --}}
    <x-footer />


</body>
</html>
