<nav role="navigation" aria-label="Menu Famille" class="bg-caramel text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            {{-- Logo / Nom du site --}}
            <div class="flex-shrink-0">
                <a href="{{ route('famille.dashboard') }}" 
                   class="font-bold text-lg hover:text-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                    👨‍👩‍👧 Mamie4Family
                </a>
            </div>

            {{-- Liens principaux (desktop) --}}
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('famille.dashboard') }}" 
                   class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                    🏠 Tableau de bord
                </a>

                <a href="{{ route('famille.profile.show') }}" 
                   class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                    👤 Mon profil
                </a>

                <a href="{{ route('famille.mamies.index') }}" 
                   class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                    👵 Trouver une Mamie
                </a>

                <a href="{{ route('famille.messages.index') }}" 
                   class="hover:text-yellow-200 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 px-2 py-1 rounded">
                    💬 Messages
                </a>
            </div>

            {{-- Menu utilisateur + déconnexion --}}
            <div class="hidden md:flex items-center space-x-3">
                <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-marron-fonce hover:bg-caramel-pastel px-3 py-1 rounded focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>

            {{-- Bouton menu mobile --}}
            <button id="menu-toggle" aria-expanded="false" aria-controls="mobile-menu"
                    class="md:hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                ☰
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div id="mobile-menu" class="hidden md:hidden bg-caramel-light px-4 pb-3 space-y-2">
        <a href="{{ route('famille.dashboard') }}" class="block py-2 hover:text-yellow-200">🏠 Tableau de bord</a>
        <a href="{{ route('famille.profile.show') }}" class="block py-2 hover:text-yellow-200">👤 Mon profil</a>
        <a href="{{ route('famille.mamies.index') }}" class="block py-2 hover:text-yellow-200">👵 Trouver une Mamie</a>
        <a href="{{ route('famille.messages.index') }}" class="block py-2 hover:text-yellow-200">💬 Messages</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left py-2 hover:text-yellow-200">🚪 Déconnexion</button>
        </form>
    </div>

    {{-- Script d’accessibilité (toggle menu mobile sans dépendance externe) --}}
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');
        });
    </script>
</nav>

