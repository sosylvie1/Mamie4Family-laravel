@extends('layouts.app')

@section('title', 'Contact | Mamie4Family')
@section('description', 'Contactez Mamie4Family pour toute question ou information.')

@section('content')
<main role="main" aria-labelledby="page-title" class="max-w-3xl mx-auto p-6">
    <h1 id="page-title" class="text-3xl font-bold text-marron-fonce mb-6">📩 Contactez-nous</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('contact.send') }}" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-marron-fonce">Votre nom</label>
            <input type="text" id="name" name="name" required
                   value="{{ old('name') }}"
                   aria-invalid="@error('name') true @else false @enderror"
                   class="mt-1 block w-full border border-caramel-pastel rounded-lg p-2">
            @error('name')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-marron-fonce">Votre email</label>
            <input type="email" id="email" name="email" required
                   value="{{ old('email') }}"
                   aria-invalid="@error('email') true @else false @enderror"
                   class="mt-1 block w-full border border-caramel-pastel rounded-lg p-2">
            @error('email')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Message --}}
        <div>
            <label for="content" class="block text-sm font-medium text-marron-fonce">Message</label>
            <textarea id="content" name="content" rows="5" required
                      aria-invalid="@error('content') true @else false @enderror"
                      class="mt-1 block w-full border border-caramel-pastel rounded-lg p-2">{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bouton --}}
        <div class="text-center">
            <button type="submit"
                    class="px-6 py-2 bg-caramel text-white rounded-md hover:bg-caramel-fonce focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caramel">
                📤 Envoyer
            </button>
        </div>
    </form>
</main>
@endsection
