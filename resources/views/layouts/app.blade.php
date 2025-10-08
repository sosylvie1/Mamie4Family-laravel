<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Titre avec intitulé exact du site --}}
    <title>{{ config('app.name', 'Mamie4Family — Annuaire relationnel entre familles et mamies') }}</title>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-sable text-marron-fonce">
    <x-banner />

    <div class="min-h-screen bg-sable">
        {{-- Navigation principale (Livewire Jetstream) --}}
        <nav class="bg-caramel shadow-md" role="navigation" aria-label="Navigation principale">
            @livewire('navigation-menu')
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-caramel-pastel shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-marron-fonce">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content je n'utilisa pas Jetstream/Livewire pour mes vues-->
        <main role="main" class="py-6">
        @yield('content')
    </main>
    </div>

    {{-- Modals --}}
    @stack('modals')

    @livewireScripts

    {{-- FOOTER global --}}
    <x-footer />

</body>

</html>
