@extends('layouts.mamie')

@section('title', 'Écrire un message - Mamie | Mamie4Family')
@section('description', 'Envoyer un message à une famille ou à un administrateur.')

@section('mamie-content')
<main role="main">
    <h1 class="text-2xl font-bold mb-4">✍️ Nouveau message</h1>

    {{-- Formulaire d’envoi --}}
    <form method="POST" action="{{ route('mamie.messages.store') }}" class="space-y-4 max-w-lg">
        @csrf

        {{-- Sélecteur destinataire --}}
        <div>
            <label for="receiver_id" class="block text-sm font-medium">Destinataire</label>
            <select name="receiver_id" id="receiver_id" required
                    class="w-full border rounded p-2">
                <optgroup label="👨‍👩‍👧 Familles">
                    @foreach($familles as $famille)
                        <option value="{{ $famille->id }}">
                            {{ $famille->name }} ({{ $famille->email }})
                        </option>
                    @endforeach
                </optgroup>
                <optgroup label="👮 Admins">
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">
                            {{ $admin->name }} ({{ $admin->email }})
                        </option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        {{-- Champ message --}}
        <div>
            <label for="content" class="block text-sm font-medium">Message</label>
            <textarea id="content" name="content" rows="5" required
                      class="w-full border rounded p-2"></textarea>
        </div>

        {{-- Bouton envoyer --}}
        <button type="submit"
                class="px-4 py-2 bg-caramel text-white rounded hover:bg-caramel-pastel">
            📤 Envoyer
        </button>
    </form>
</main>
@endsection
