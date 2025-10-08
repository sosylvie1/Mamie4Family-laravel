<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Espace Famille | Mamie4Family')</title>
    <meta name="description" content="@yield('description', 'Espace personnel des familles sur Mamie4Family')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-sable text-marron-fonce">
    <div class="min-h-screen flex">

        {{-- ===== ASIDE MENU FAMILLE ===== --}}
        <aside class="w-64 bg-caramel text-marron-fonce flex flex-col">
            <div class="p-4 text-xl font-bold border-b border-caramel-pastel">
                👨‍👩‍👧 Mamie4Family<br>
                <span class="text-sm">Espace Famille</span>
            </div>

            <nav class="flex-1 p-4 space-y-2" role="navigation" aria-label="Menu Famille">
                <a href="{{ route('famille.dashboard') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel @if (request()->routeIs('famille.dashboard')) bg-caramel-pastel font-semibold @endif">
                    📊 Tableau de bord
                </a>

                <a href="{{ route('famille.profile.edit') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel @if (request()->routeIs('famille.profile.*')) bg-caramel-pastel font-semibold @endif">
                    ⚙️ Mon profil
                </a>

                <a href="{{ route('famille.messages.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel @if (request()->routeIs('famille.messages.*')) bg-caramel-pastel font-semibold @endif">
                    💬 Messages
                </a>

                <a href="{{ route('mamies.index') }}"
                    class="block py-2 px-3 rounded hover:bg-caramel-pastel @if (request()->routeIs('mamies.*')) bg-caramel-pastel font-semibold @endif">
                    🧓 Voir catalogue Mamies
                </a>

                {{-- Séparateur visuel --}}
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
            @yield('famille-content')
        </main>
    </div>

    @livewireScripts
</body>

</html>
