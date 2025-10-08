{{-- resources/views/colors.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Charte UI | Mamie4Family</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-sable text-marron-fonce font-sans antialiased">

    <div class="max-w-6xl mx-auto py-12 px-6">

        {{-- MENU DE NAVIGATION --}}
        <nav class="mb-12 flex space-x-6 justify-center font-semibold">
            <a href="#palette" class="text-marron-fonce hover:text-caramel-fonce">🎨 Palette</a>
            <a href="#boutons" class="text-marron-fonce hover:text-caramel-fonce">🔘 Boutons</a>
            <a href="#alertes" class="text-marron-fonce hover:text-caramel-fonce">⚠️ Alertes</a>
        </nav>

        {{-- PALETTE --}}
        <section id="palette">
            <h1 class="text-3xl font-bold mb-8">🎨 Palette Mamie4Family</h1>
            <p class="mb-8 text-taupe">
                Voici les couleurs principales utilisées dans le site.
                Chaque bloc affiche la couleur + la classe Tailwind personnalisée.
            </p>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 rounded-lg shadow bg-marron-fonce text-sable">
                    <p class="font-bold">bg-marron-fonce</p>
                    <p>#3B2F2F</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-caramel text-marron-fonce">
                    <p class="font-bold">bg-caramel</p>
                    <p>#D7A86E</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-caramel-fonce text-white">
                    <p class="font-bold">bg-caramel-fonce</p>
                    <p>#A66E37</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-caramel-pastel text-marron-fonce">
                    <p class="font-bold">bg-caramel-pastel</p>
                    <p>#E6C9A8</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-sable text-marron-fonce">
                    <p class="font-bold">bg-sable</p>
                    <p>#FAF9F6</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-taupe text-sable">
                    <p class="font-bold">bg-taupe</p>
                    <p>#6B5E54</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-rose text-marron-fonce">
                    <p class="font-bold">bg-rose</p>
                    <p>#E7C6B9</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-sauge text-marron-fonce">
                    <p class="font-bold">bg-sauge</p>
                    <p>#B5C99A</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-brume text-marron-fonce">
                    <p class="font-bold">bg-brume</p>
                    <p>#A7BBC7</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-terrecuite text-white">
                    <p class="font-bold">bg-terrecuite</p>
                    <p>#C97C5D</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-ocre text-marron-fonce">
                    <p class="font-bold">bg-ocre</p>
                    <p>#E0B973</p>
                </div>
                <div class="p-6 rounded-lg shadow bg-olive text-marron-fonce">
                    <p class="font-bold">bg-olive</p>
                    <p>#9BB37B</p>
                </div>
            </div>
        </section>

        {{-- BOUTONS --}}
        <section id="boutons" class="mt-16">
            <h2 class="text-2xl font-bold mb-6">🔘 Boutons</h2>
            <div class="flex flex-wrap gap-4">
                <button
                    class="bg-caramel text-marron-fonce font-bold px-4 py-2 rounded hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-sauge">Bouton
                    caramel</button>
                <button
                    class="bg-marron-fonce text-sable px-4 py-2 rounded hover:bg-caramel focus:outline-none focus:ring-2 focus:ring-sauge">Bouton
                    marron foncé</button>
                <button
                    class="bg-sauge text-marron-fonce px-4 py-2 rounded hover:bg-olive focus:outline-none focus:ring-2 focus:ring-caramel">Bouton
                    sauge</button>
                <button
                    class="bg-rose text-marron-fonce px-4 py-2 rounded hover:bg-caramel focus:outline-none focus:ring-2 focus:ring-olive">Bouton
                    rose</button>
            </div>
        </section>

        {{-- ALERTES --}}
        <section id="alertes" class="mt-16">
            <h2 class="text-2xl font-bold mb-6">⚠️ Alertes</h2>
            <div class="space-y-4">
                <div class="bg-olive text-marron-fonce p-4 rounded-lg">✅ Succès : Action réussie</div>
                <div class="bg-ocre text-marron-fonce p-4 rounded-lg">⚠️ Avertissement : Vérifiez vos infos</div>
                <div class="bg-terrecuite text-white p-4 rounded-lg">❌ Erreur : Quelque chose s’est mal passé</div>
                <div class="bg-brume text-marron-fonce p-4 rounded-lg">ℹ️ Info : Exemple d’information</div>
            </div>
        </section>
    </div>
</body>

</html>
