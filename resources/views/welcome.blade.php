@extends('layouts.app')

@section('title', 'Accueil | Mamie4Family')
@section('description', 'Mamie4Family relie des familles et des mamies pour créer du lien humain et intergénérationnel.')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16 text-center">
    <h2 class="text-4xl font-bold mb-4 text-marron-fonce">
        Annuaire relationnel entre familles et mamies
    </h2>
    <p class="text-lg text-taupe mb-8 max-w-2xl mx-auto">
        Mamie4Family met en relation des familles et des mamies disponibles pour partager du temps,
        transmettre leur expérience et créer de vraies relations humaines.
    </p>

    {{-- Boutons d’accès --}}
    <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ url('/login?role=famille') }}"
           class="bg-caramel hover:bg-caramel-pastel text-white font-semibold px-6 py-3 rounded-lg shadow-md focus:ring-2 focus:ring-caramel">
           👨‍👩‍👧 Accéder à l’espace Famille
        </a>

        <a href="{{ url('/login?role=mamie') }}"
           class="bg-caramel hover:bg-caramel-pastel text-white font-semibold px-6 py-3 rounded-lg shadow-md focus:ring-2 focus:ring-caramel">
           👵 Accéder à l’espace Mamie
        </a>

        <a href="{{ url('/login?role=admin') }}"
           class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md focus:ring-2 focus:ring-gray-500">
           ⚙️ Accéder à l’espace Admin
        </a>
    </div>
</section>

{{-- SECTION EXPLICATION --}}
<section class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-6">
    <div class="bg-caramel-pastel text-marron-fonce p-6 rounded-xl shadow border border-caramel">
        <h3 class="text-xl font-semibold mb-2">👩 Familles</h3>
        <p>Trouvez une mamie de cœur pour vos enfants : bienveillance et proximité au rendez-vous.</p>
    </div>
    <div class="bg-rose text-marron-fonce p-6 rounded-xl shadow border border-caramel">
        <h3 class="text-xl font-semibold mb-2">👵 Mamies</h3>
        <p>Partagez votre temps et vos histoires avec des familles à la recherche d’une présence chaleureuse.</p>
    </div>
    <div class="bg-sauge text-marron-fonce p-6 rounded-xl shadow border border-caramel">
        <h3 class="text-xl font-semibold mb-2">🤝 Ensemble</h3>
        <p>Renforçons le lien entre générations et luttons contre l’isolement, ensemble.</p>
    </div>
</section>
@endsection
