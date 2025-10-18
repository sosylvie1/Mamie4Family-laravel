@extends('layouts.app')

@section('title', 'Politique de Confidentialité | Mamie4Family')
@section('description', 'Découvrez comment Mamie4Family protège vos données personnelles et respecte votre vie privée.')

@section('content')
<main role="main" aria-labelledby="page-title" class="min-h-screen bg-sable-clair py-10 px-4">
    <article class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-8 prose prose-lg text-marron-fonce leading-relaxed">
        <header class="mb-6 border-b border-caramel-pastel pb-4">
            <h1 id="page-title" class="text-3xl font-bold text-marron-fonce flex items-center gap-2">
                🔒 Politique de Confidentialité
            </h1>
            <p class="text-gray-600 text-base mt-1">
                Dernière mise à jour : {{ date('d/m/Y') }}
            </p>
        </header>

        <section aria-labelledby="donnees-collectees">
            <h2 id="donnees-collectees" class="text-2xl font-semibold text-caramel-fonce mt-6">
                1. Données collectées
            </h2>
            <p>
                La plateforme <strong>Mamie4Family</strong> attache une grande importance à la protection de vos données personnelles.
                Nous ne collectons que les informations nécessaires à la création et à la gestion de votre compte :
                <ul class="list-disc list-inside">
                    <li>Nom et prénom</li>
                    <li>Adresse e-mail</li>
                    <li>Numéro de téléphone</li>
                    <li>Adresse, ville, code postal et département</li>
                </ul>
            </p>
        </section>

        <section aria-labelledby="utilisation-donnees">
            <h2 id="utilisation-donnees" class="text-2xl font-semibold text-caramel-fonce mt-6">
                2. Utilisation des données
            </h2>
            <p>
                Vos données servent exclusivement à :
            </p>
            <ul class="list-disc list-inside">
                <li>La mise en relation entre familles et mamies,</li>
                <li>La gestion de votre profil utilisateur,</li>
                <li>La communication interne (notifications, messages),</li>
                <li>Et à l’amélioration continue du service.</li>
            </ul>
        </section>

        <section aria-labelledby="protection-donnees">
            <h2 id="protection-donnees" class="text-2xl font-semibold text-caramel-fonce mt-6">
                3. Protection et sécurité
            </h2>
            <p>
                Nous mettons en œuvre des mesures techniques et organisationnelles pour protéger vos informations
                contre toute perte, accès non autorisé, altération ou destruction :
            </p>
            <ul class="list-disc list-inside">
                <li>Stockage sécurisé sur nos serveurs protégés,</li>
                <li>Chiffrement des mots de passe,</li>
                <li>Accès restreint aux seules personnes habilitées.</li>
            </ul>
        </section>

        <section aria-labelledby="partage-donnees">
            <h2 id="partage-donnees" class="text-2xl font-semibold text-caramel-fonce mt-6">
                4. Partage des données
            </h2>
            <p>
                Vos données ne sont <strong>jamais revendues</strong> à des tiers.  
                Elles ne sont partagées qu’avec les personnes impliquées dans la relation entre
                <strong>Familles</strong> et <strong>Mamies</strong> au sein de la plateforme.
            </p>
        </section>

        <section aria-labelledby="duree-conservation">
            <h2 id="duree-conservation" class="text-2xl font-semibold text-caramel-fonce mt-6">
                5. Durée de conservation
            </h2>
            <p>
                Vos données sont conservées pendant la durée d’utilisation de votre compte et jusqu’à
                <strong>12 mois après sa suppression</strong>, sauf obligation légale contraire.
            </p>
        </section>

        <section aria-labelledby="vos-droits">
            <h2 id="vos-droits" class="text-2xl font-semibold text-caramel-fonce mt-6">
                6. Vos droits
            </h2>
            <p>
                Conformément au Règlement Général sur la Protection des Données (RGPD),
                vous disposez des droits suivants :
            </p>
            <ul class="list-disc list-inside">
                <li>Droit d’accès et de rectification de vos données,</li>
                <li>Droit à l’effacement (“droit à l’oubli”),</li>
                <li>Droit à la limitation du traitement,</li>
                <li>Droit à la portabilité de vos données.</li>
            </ul>
            <p>
                Pour exercer vos droits, vous pouvez nous contacter à l’adresse :
                <a href="mailto:contact@mamie4family.fr" class="text-caramel-fonce underline hover:text-caramel">
                    contact@mamie4family.fr
                </a>.
            </p>
        </section>

        <section aria-labelledby="cookies">
            <h2 id="cookies" class="text-2xl font-semibold text-caramel-fonce mt-6">
                7. Cookies
            </h2>
            <p>
                Le site utilise des cookies techniques nécessaires à son bon fonctionnement.
                Vous pouvez gérer vos préférences de cookies à tout moment via la bannière d’information affichée lors de votre première visite.
            </p>
        </section>

        <section aria-labelledby="contact-rgpd" class="mt-8 border-t border-caramel-pastel pt-6">
            <h2 id="contact-rgpd" class="text-2xl font-semibold text-caramel-fonce">📧 Contact RGPD</h2>
            <p>
                Pour toute question relative à la gestion de vos données personnelles,  
                merci d’adresser votre demande à :
                <strong class="text-marron-fonce">contact@mamie4family.fr</strong>
            </p>
        </section>
    </article>
</main>
@endsection
