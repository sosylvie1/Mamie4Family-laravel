{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>@yield('title', 'Mamie4Family — Annuaire entre familles et mamies')</title>
    <meta name="description" content="@yield('description', 'Trouvez une mamie ou une famille de confiance sur Mamie4Family, la plateforme de mise en relation bienveillante.')">

    @if (app()->environment('local'))
    {{-- 💻 Environnement local : Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    {{-- 🌐 Environnement production : fichiers statiques (PlanetHoster) --}}
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <script src="{{ secure_asset('js/app.js') }}"></script>
@endif

</head>

<body class="font-sans antialiased bg-sable text-marron-fonce min-h-screen flex flex-col">

    {{-- ===== BARRE DE NAVIGATION PUBLIQUE ===== --}}
    @include('partials.universal-nav')

    {{-- ===== CONTENU PRINCIPAL ===== --}}
    <main role="main" class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    {{-- ===== PIED DE PAGE GÉNÉRAL ===== --}}
    <footer class="bg-caramel text-white py-4 text-center border-t border-caramel-pastel">
        <p class="text-sm">
            © {{ date('Y') }} Mamie4Family — Tous droits réservés
        </p>
        <p class="text-xs mt-1">
            <a href="{{ route('cgu') }}" class="hover:underline focus-visible:ring-2 focus-visible:ring-yellow-400">CGU</a> ·
            <a href="{{ route('confidentialite') }}" class="hover:underline focus-visible:ring-2 focus-visible:ring-yellow-400">Confidentialité</a> ·
            <a href="{{ route('plan-du-site') }}" class="hover:underline focus-visible:ring-2 focus-visible:ring-yellow-400">Plan du site</a>
        </p>
    </footer>

    {{-- ✅ Scripts locaux (aucun CDN, aucun framework bloquant) --}}
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
