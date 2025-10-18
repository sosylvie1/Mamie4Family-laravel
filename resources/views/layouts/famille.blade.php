{{-- resources/views/layouts/famille.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>@yield('title', 'Espace Famille | Mamie4Family')</title>
    <meta name="description" content="@yield('description', 'Espace personnel des familles sur Mamie4Family')">

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
        {{-- ===== ASIDE MENU FAMILLE ===== --}}
        <aside class="w-64 bg-caramel text-marron-fonce flex flex-col" role="navigation" aria-label="Menu Famille">
            <div class="p-4 text-xl font-bold border-b border-caramel-pastel">
                👨‍👩‍👧 Mamie4Family<br>
                <span class="text-sm">Espace Famille</span>
            </div>

            <nav class="flex-1 p-4 space-y-2">
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
                    👵 Voir catalogue Mamies
                </a>

                <hr class="border-yellow-400 my-3 opacity-50">

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
<main role="main" class="flex-1 bg-sable-clair p-6 overflow-y-auto" aria-label="Contenu principal Famille">

    {{-- 🎉 Bannière de bienvenue (accessible et contrastée) --}}
    <section 
        class="bg-gradient-to-r from-caramel-fonce via-caramel to-caramel-pastel text-white rounded-xl shadow-lg p-5 mb-6 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-white"
        aria-labelledby="welcome-banner">

        <h1 id="welcome-banner" class="text-2xl font-extrabold tracking-tight">
            👋 Bonjour <span class="underline underline-offset-2 decoration-yellow-300">{{ Auth::user()->name ?? 'Famille' }}</span> !
        </h1>

        <p class="text-white/90 text-sm mt-1">
            Heureux de vous revoir sur <strong>Mamie4Family</strong> 💛<br>
            Vous pouvez gérer votre profil, consulter vos messages, ou explorer nos Mamies disponibles.
        </p>
    </section>

    {{-- 🧱 Zone principale du contenu --}}
    <div class="bg-white rounded-xl shadow-sm p-6 text-gray-800 leading-relaxed">
        @yield('famille-content')
    </div>

</main>


    

    {{-- Scripts (facultatif si tu as un JS local) --}}
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
