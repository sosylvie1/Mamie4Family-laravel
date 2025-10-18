{{-- resources/views/partials/universal-nav.blade.php --}}
<nav role="navigation" aria-label="Menu principal" class="bg-caramel text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('welcome') }}" 
                   class="font-bold text-lg hover:text-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                    👵 Mamie4Family
                </a>
            </div>

            {{-- Liens principaux (desktop) --}}
            <div class="hidden md:flex space-x-6">
                @guest
                    <a href="{{ route('welcome') }}" class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                        🏠 Accueil
                    </a>
                    <a href="{{ route('mamies.index') }}" class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                        👵 Nos Mamies
                    </a>
                    <a href="{{ route('contact') }}" class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                        ✉️ Contactez-nous
                    </a>
                @endguest

                @auth
                    {{-- Liens selon rôle --}}
                    @if(auth()->user()->isFamille())
                        <a href="{{ route('famille.dashboard') }}" class="hover:text-yellow-200 px-2 py-1 rounded">🏠 Tableau de bord</a>
                        <a href="{{ route('famille.profile.show') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👤 Mon profil</a>
                        <a href="{{ route('famille.mamies.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👵 Trouver une Mamie</a>
                        <a href="{{ route('famille.messages.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">💬 Messages</a>

                    @elseif(auth()->user()->isMamie())
                        <a href="{{ route('mamie.dashboard') }}" class="hover:text-yellow-200 px-2 py-1 rounded">🏠 Tableau de bord</a>
                        <a href="{{ route('mamie.profile.show') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👵 Mon profil</a>
                        <a href="{{ route('mamie.familles.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👨‍👩‍👧 Familles</a>
                        <a href="{{ route('mamie.messages.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">💬 Messages</a>

                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-200 px-2 py-1 rounded">🛠 Dashboard Admin</a>
                        <a href="{{ route('admin.mamies.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👵 Gérer Mamies</a>
                        <a href="{{ route('admin.familles.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">👨‍👩‍👧 Gérer Familles</a>
                        <a href="{{ route('admin.messages.index') }}" class="hover:text-yellow-200 px-2 py-1 rounded">💬 Messages</a>
                    @endif
                @endauth
            </div>

            {{-- Zone utilisateur (desktop) --}}
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-marron-fonce hover:bg-caramel-pastel px-3 py-1 rounded focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                            🚪 Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-yellow-200">🔑 Connexion</a>
                @endauth
            </div>

            {{-- Bouton mobile --}}
            <button id="menu-toggle" aria-expanded="false" aria-controls="mobile-menu"
                    class="md:hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                ☰
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div id="mobile-menu" class="hidden md:hidden bg-caramel-light px-4 pb-3 space-y-2">
        @guest
            <a href="{{ route('welcome') }}" class="block py-2 hover:text-yellow-200">🏠 Accueil</a>
            <a href="{{ route('mamies.index') }}" class="block py-2 hover:text-yellow-200">👵 Nos Mamies</a>
            <a href="{{ route('contact') }}" class="block py-2 hover:text-yellow-200">✉️ Contactez-nous</a>
        @endguest

        @auth
            @if(auth()->user()->isFamille())
                <a href="{{ route('famille.dashboard') }}" class="block py-2 hover:text-yellow-200">🏠 Tableau de bord</a>
                <a href="{{ route('famille.profile.show') }}" class="block py-2 hover:text-yellow-200">👤 Mon profil</a>
                <a href="{{ route('famille.mamies.index') }}" class="block py-2 hover:text-yellow-200">👵 Trouver une Mamie</a>
                <a href="{{ route('famille.messages.index') }}" class="block py-2 hover:text-yellow-200">💬 Messages</a>

            @elseif(auth()->user()->isMamie())
                <a href="{{ route('mamie.dashboard') }}" class="block py-2 hover:text-yellow-200">🏠 Tableau de bord</a>
                <a href="{{ route('mamie.profile.show') }}" class="block py-2 hover:text-yellow-200">👵 Mon profil</a>
                <a href="{{ route('mamie.familles.index') }}" class="block py-2 hover:text-yellow-200">👨‍👩‍👧 Familles</a>
                <a href="{{ route('mamie.messages.index') }}" class="block py-2 hover:text-yellow-200">💬 Messages</a>

            @elseif(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="block py-2 hover:text-yellow-200">🛠 Dashboard Admin</a>
                <a href="{{ route('admin.mamies.index') }}" class="block py-2 hover:text-yellow-200">👵 Gérer Mamies</a>
                <a href="{{ route('admin.familles.index') }}" class="block py-2 hover:text-yellow-200">👨‍👩‍👧 Gérer Familles</a>
                <a href="{{ route('admin.messages.index') }}" class="block py-2 hover:text-yellow-200">💬 Messages</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left py-2 hover:text-yellow-200">🚪 Déconnexion</button>
            </form>
        @endauth
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');
        });
    </script>
</nav>
