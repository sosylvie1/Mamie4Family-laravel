{{-- resources/views/navigation.blade.php ne pas l 'utiliser' --}}
<nav x-data="{ open: false }"
     class="bg-caramel border-b border-caramel-pastel"
     role="navigation"
     aria-label="Navigation principale">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- LOGO / NOM DU SITE --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="text-xl font-bold text-marron-fonce">
                        👵 Mamie4Family
                    </a>
                </div>

                {{-- MENU LINKS (desktop) --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- Liens publics --}}
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" class="text-marron-fonce hover:text-caramel-fonce">
                        🏠 Accueil
                    </x-nav-link>

                    <x-nav-link href="{{ route('mamies.index') }}" :active="request()->routeIs('mamies.*')" class="text-marron-fonce hover:text-caramel-fonce">
                        🧓 Catalogue Mamies
                    </x-nav-link>

                    

                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="text-marron-fonce hover:text-caramel-fonce">
                        ✉️ Contact
                    </x-nav-link>

                    {{-- Menu selon rôle (si connecté) --}}
                    @auth
                        @if(auth()->user()->isAdmin())
                            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.*')" class="text-marron-fonce hover:text-caramel-fonce">
                                🛠 Admin
                            </x-nav-link>
                        @elseif(auth()->user()->isFamille())
                            <x-nav-link href="{{ route('famille.dashboard') }}" :active="request()->routeIs('famille.*')" class="text-marron-fonce hover:text-caramel-fonce">
                                👨‍👩‍👧 Espace Famille
                            </x-nav-link>
                        @elseif(auth()->user()->isMamie())
                            <x-nav-link href="{{ route('mamie.dashboard') }}" :active="request()->routeIs('mamie.*')" class="text-marron-fonce hover:text-caramel-fonce">
                                👵 Espace Mamie
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- DROPDOWN / UTILISATEUR --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            🚪 Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="text-marron-fonce hover:text-caramel-fonce px-3 py-2 rounded-md text-sm font-medium">
                        🔑 Connexion
                    </a>
                @endauth
            </div>

            {{-- MENU BURGER (mobile) --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-marron-fonce hover:text-caramel-fonce hover:bg-caramel-pastel focus:outline-none focus:ring-2 focus:ring-sauge"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-sable border-t border-caramel-pastel">
        <div class="pt-2 pb-3 space-y-1">

            {{-- Liens publics mobile --}}
            <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">🏠 Accueil</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('mamies.index') }}" :active="request()->routeIs('mamies.*')">🧓 Catalogue Mamies</x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">✉️ Contact</x-responsive-nav-link>

            {{-- Liens selon rôle --}}
            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link href="{{ route('admin.dashboard') }}">🛠 Admin</x-responsive-nav-link>
                @elseif(auth()->user()->isFamille())
                    <x-responsive-nav-link href="{{ route('famille.dashboard') }}">👨‍👩‍👧 Espace Famille</x-responsive-nav-link>
                @elseif(auth()->user()->isMamie())
                    <x-responsive-nav-link href="{{ route('mamie.dashboard') }}">👵 Espace Mamie</x-responsive-nav-link>
                @endif
            @endauth
        </div>

        {{-- Déconnexion mobile --}}
        <div class="pt-4 pb-1 border-t border-caramel-pastel">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="px-4">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 hover:text-red-800 py-2">
                        🚪 Déconnexion
                    </button>
                </form>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="block py-2">🔑 Connexion</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
