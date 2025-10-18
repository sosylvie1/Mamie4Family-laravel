{{-- resources/views/layouts/mamie.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>@yield('title', 'Espace Mamie | Mamie4Family')</title>
    <meta name="description" content="@yield('description', 'Espace personnel des mamies sur Mamie4Family')">

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

    {{-- ===== BARRE DE NAVIGATION UNIVERSELLE ===== --}}
    @include('partials.universal-nav')

    <div class="flex flex-1">
        {{-- ===== ASIDE MENU MAMIE ===== --}}
        <aside class="w-64 bg-caramel text-marron-fonce flex flex-col" role="navigation" aria-label="Menu Mamie">
            <div class="p-4 text-xl font-bold border-b border-caramel-pastel">
                👵 Mamie4Family<br>
                <span class="text-sm">Espace Mamie</span>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                {{-- Tableau de bord --}}
                <a href="{{ route('mamie.dashboard') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('mamie.dashboard')) bg-caramel-pastel font-semibold @endif">
                    📊 Tableau de bord
                </a>

                {{-- Mon profil --}}
                <a href="{{ route('mamie.profile.show') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('mamie.profile.*')) bg-caramel-pastel font-semibold @endif">
                    👤 Mon profil
                </a>

                {{-- Messages --}}
                <a href="{{ route('mamie.messages.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('mamie.messages.*')) bg-caramel-pastel font-semibold @endif">
                    💌 Messages
                </a>

                {{-- Voir les familles disponibles --}}
                <a href="{{ route('mamie.familles.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('mamie.familles.*')) bg-caramel-pastel font-semibold @endif">
                    👨‍👩‍👧 Voir les familles
                </a>

                <hr class="border-yellow-400 my-3 opacity-50">

                {{-- Bloc bas : accueil et déconnexion --}}
                <div class="flex flex-col items-start space-y-2 mt-4">
                    <a href="{{ route('welcome') }}"
                        class="hover:underline focus-visible:ring-2 focus-visible:ring-yellow-400"
                        aria-label="Retour à l’accueil">
                        🏠 Retour accueil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="hover:underline focus-visible:ring-2 focus-visible:ring-yellow-400"
                            aria-label="Se déconnecter">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </nav>

            <footer class="p-4 border-t border-caramel-pastel text-sm text-center">
                © {{ date('Y') }} Mamie4Family
            </footer>
        </aside>

        {{-- ===== CONTENU PRINCIPAL ===== --}}
        <main role="main" class="flex-1 p-6 overflow-y-auto">
            @yield('mamie-content')
        </main>
    </div>

    {{-- ✅ Scripts locaux --}}
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
