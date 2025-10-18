{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>@yield('title', 'Espace Admin | Mamie4Family')</title>
    <meta name="description" content="@yield('description', 'Tableau de bord administrateur de Mamie4Family')">

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
        {{-- ===== ASIDE MENU ADMIN ===== --}}
        <aside class="w-64 bg-caramel text-marron-fonce flex flex-col" role="navigation" aria-label="Menu Admin">
            <div class="p-4 text-xl font-bold border-b border-caramel-pastel">
                👵 Mamie4Family<br>
                <span class="text-sm">Espace Admin</span>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.dashboard')) bg-caramel-pastel font-semibold @endif">
                    📊 Dashboard
                </a>

                <a href="{{ route('admin.familles.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.familles.*')) bg-caramel-pastel font-semibold @endif">
                    👨‍👩‍👧 Familles
                </a>

                <a href="{{ route('admin.mamies.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.mamies.*')) bg-caramel-pastel font-semibold @endif">
                    👵 Mamies
                </a>

                <a href="{{ route('admin.messages.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.messages.*')) bg-caramel-pastel font-semibold @endif">
                    💬 Messages
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.users.*')) bg-caramel-pastel font-semibold @endif">
                    👥 Utilisateurs
                </a>

                <a href="{{ route('admin.profile.show') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel 
                    @if (request()->routeIs('admin.profile.*')) bg-caramel-pastel font-semibold @endif">
                    ⚙️ Profil
                </a>

                <hr class="border-yellow-400 my-3 opacity-50">

                {{-- Bloc bas : Accueil et Déconnexion --}}
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
            @yield('admin-content')
        </main>
    </div>

    {{-- ✅ Script JS local (aucun CDN, aucune dépendance bloquante) --}}
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
