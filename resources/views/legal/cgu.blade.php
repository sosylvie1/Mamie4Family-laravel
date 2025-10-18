{{-- resources/views/legal/cgu.blade.php --}}
@extends('layouts.app')

@section('title', 'Conditions Générales d’Utilisation | Mamie4Family')
@section('description', 'Prenez connaissance des conditions d’utilisation de la plateforme Mamie4Family et de vos droits en tant qu’utilisateur.')

@section('content')
<main role="main" aria-labelledby="page-title" class="min-h-screen bg-sable-clair py-10 px-4">
    <article class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-8 prose prose-lg text-marron-fonce leading-relaxed">
        <header class="mb-6 border-b border-caramel-pastel pb-4">
            <h1 id="page-title" class="text-3xl font-bold text-marron-fonce flex items-center gap-2">
                📜 Conditions Générales d’Utilisation (CGU)
            </h1>
            <p class="text-gray-600 text-base mt-1">
                Dernière mise à jour : {{ date('d/m/Y') }}
            </p>
        </header>

        <section aria-labelledby="objet">
            <h2 id="objet" class="text-2xl font-semibold text-caramel-fonce mt-6">
                1. Objet
            </h2>
            <p>
                Les présentes <strong>Conditions Générales d’Utilisation</strong> régissent l’accès et l’utilisation de la plateforme
                <strong>Mamie4Family</strong>, accessible à l’adresse
                <a href="{{ url('/') }}" class="text-caramel-fonce underline hover:text-caramel">www.mamie4family.fr</a>.
                En utilisant le site, l’utilisateur reconnaît avoir lu, compris et accepté l’intégralité de ces conditions.
            </p>
        </section>

        <section aria-labelledby="acces-site">
            <h2 id="acces-site" class="text-2xl font-semibold text-caramel-fonce mt-6">
                2. Accès au site
            </h2>
            <p>
                L’accès à la plateforme est gratuit pour tout utilisateur disposant d’un accès Internet.
                Certaines fonctionnalités nécessitent la création d’un compte <strong>Famille</strong> ou <strong>Mamie</strong>.
            </p>
        </section>

        <section aria-labelledby="inscription">
            <h2 id="inscription" class="text-2xl font-semibold text-caramel-fonce mt-6">
                3. Inscription et comptes utilisateurs
            </h2>
            <p>
                Pour utiliser les services proposés, l’utilisateur doit s’inscrire en fournissant des informations exactes et à jour.
                Chaque compte est personnel et ne peut être transféré à un tiers.
            </p>
            <p>
                L’utilisateur est responsable de la confidentialité de ses identifiants et de toute activité réalisée via son compte.
            </p>
        </section>

        <section aria-labelledby="responsabilite">
            <h2 id="responsabilite" class="text-2xl font-semibold text-caramel-fonce mt-6">
                4. Responsabilité des utilisateurs
            </h2>
            <p>
                Les utilisateurs s’engagent à utiliser la plateforme dans le respect des lois en vigueur et des valeurs de bienveillance
                propres à <strong>Mamie4Family</strong>.
            </p>
            <ul class="list-disc list-inside">
                <li>Ne pas diffuser de propos injurieux, discriminatoires ou diffamatoires.</li>
                <li>Respecter la vie privée des autres utilisateurs.</li>
                <li>Fournir des informations exactes dans leur profil.</li>
            </ul>
        </section>

        <section aria-labelledby="responsabilite-plateforme">
            <h2 id="responsabilite-plateforme" class="text-2xl font-semibold text-caramel-fonce mt-6">
                5. Responsabilité de la plateforme
            </h2>
            <p>
                <strong>Mamie4Family</strong> met tout en œuvre pour assurer le bon fonctionnement du site et la sécurité des échanges.
                Cependant, la plateforme ne peut être tenue responsable :
            </p>
            <ul class="list-disc list-inside">
                <li>Des interruptions temporaires du service pour maintenance,</li>
                <li>Des dommages résultant d’un usage inapproprié du site,</li>
                <li>Ou des contenus publiés par les utilisateurs eux-mêmes.</li>
            </ul>
        </section>

        <section aria-labelledby="propriete-intellectuelle">
            <h2 id="propriete-intellectuelle" class="text-2xl font-semibold text-caramel-fonce mt-6">
                6. Propriété intellectuelle
            </h2>
            <p>
                Tous les éléments présents sur le site (textes, images, logos, design, code) sont protégés par le droit de la propriété intellectuelle.
                Toute reproduction, représentation ou diffusion sans autorisation est interdite.
            </p>
        </section>

        <section aria-labelledby="donnees-personnelles">
            <h2 id="donnees-personnelles" class="text-2xl font-semibold text-caramel-fonce mt-6">
                7. Données personnelles
            </h2>
            <p>
                La collecte et le traitement de vos données sont régis par la
                <a href="{{ route('confidentialite') }}" class="text-caramel-fonce underline hover:text-caramel">
                    Politique de Confidentialité
                </a> disponible sur notre site.
            </p>
        </section>

        <section aria-labelledby="modification-conditions">
            <h2 id="modification-conditions" class="text-2xl font-semibold text-caramel-fonce mt-6">
                8. Modification des conditions
            </h2>
            <p>
                <strong>Mamie4Family</strong> se réserve le droit de modifier les présentes CGU à tout moment.
                Les utilisateurs seront informés de toute mise à jour par affichage sur le site.
            </p>
        </section>

        <section aria-labelledby="droit-applicable">
            <h2 id="droit-applicable" class="text-2xl font-semibold text-caramel-fonce mt-6">
                9. Droit applicable
            </h2>
            <p>
                Les présentes conditions sont soumises au droit français.  
                Tout litige relatif à leur interprétation ou leur exécution sera de la compétence exclusive des tribunaux français.
            </p>
        </section>

        <section aria-labelledby="contact">
            <h2 id="contact" class="text-2xl font-semibold text-caramel-fonce mt-6">
                📧 Contact
            </h2>
            <p>
                Pour toute question relative à ces conditions, vous pouvez contacter notre équipe à :
                <a href="mailto:contact@mamie4family.fr" class="text-caramel-fonce underline hover:text-caramel">
                    contact@mamie4family.fr
                </a>.
            </p>
        </section>
    </article>
</main>
@endsection
