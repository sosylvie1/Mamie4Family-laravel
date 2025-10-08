@extends('layouts.app')

@section('title', 'Accueil | Mamie4Family')
@section('description', 'Mamie4Family met en relation des familles et des mamies disponibles pour partager du temps.')

@section('content')
    {{-- HERO --}}
    <section class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h2 class="text-4xl font-bold mb-4 text-marron-fonce">
            Annuaire relationnel entre familles et mamies
        </h2>
        <p class="text-lg text-taupe mb-6 max-w-2xl mx-auto">
            Mamie4Family met en relation des familles et des mamies disponibles pour partager du temps,
            transmettre leur expérience et créer de vraies relations humaines.
        </p>
        <div class="space-x-4">
            <a href="{{ route('login') }}"
               class="bg-caramel hover:bg-caramel-fonce text-white font-bold px-6 py-3 rounded-lg shadow-md">
                🏠 Accédez à votre espace Famille
            </a>
            <a href="{{ route('login') }}"
               class="bg-sauge hover:bg-olive text-white font-bold px-6 py-3 rounded-lg shadow-md">
                👵 Accédez à votre espace Mamie
            </a>
        </div>
    </section>

    {{-- SECTION EXPLICATION --}}
    <section class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-6">
        <div class="bg-caramel-pastel text-marron-fonce p-6 rounded-xl shadow border border-caramel">
            <h3 class="text-xl font-semibold mb-2">👩 Familles</h3>
            <p>Vous cherchez une mamie de cœur pour vos enfants ? Trouvez facilement une personne bienveillante près de chez vous.</p>
        </div>
        <div class="bg-rose text-marron-fonce p-6 rounded-xl shadow border border-caramel">
            <h3 class="text-xl font-semibold mb-2">👵 Mamies</h3>
            <p>Envie de partager vos histoires, votre temps et vos talents ? Rejoignez l’annuaire et entrez en contact avec des familles.</p>
        </div>
        <div class="bg-sauge text-marron-fonce p-6 rounded-xl shadow border border-caramel">
            <h3 class="text-xl font-semibold mb-2">🤝 Ensemble</h3>
            <p>Favorisons les rencontres, luttons contre l’isolement et renforçons le lien intergénérationnel.</p>
        </div>
    </section>
@endsection
