<footer class="bg-marron-fonce text-sable py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('welcome') }}" class="flex items-center text-xl font-bold">
                <span class="text-2xl">👵</span>
                <span class="ml-2">Mamie4Family</span>
            </a>
        </div>

        <div class="flex space-x-6 text-sm">
            <a href="{{ route('welcome') }}" class="hover:underline">Accueil</a>
            <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
            <a href="#">À propos</a>
            <a href="/cgu" class="hover:underline">CGU</a>
        </div>

        <div class="text-xs text-gray-300">
            &copy; {{ date('Y') }} Mamie4Family. Tous droits réservés.
        </div>
    </div>
</footer>
