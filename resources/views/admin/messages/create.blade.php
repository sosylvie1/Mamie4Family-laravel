@extends('layouts.admin')

@section('title', 'Nouveau message - Admin | Mamie4Family')
@section('description', 'Formulaire Admin pour écrire et envoyer un message aux familles ou mamies.')

@section('admin-content')
    <main role="main" aria-labelledby="page-title">
        <h1 id="page-title" class="text-2xl font-bold mb-4">➕ Nouveau message</h1>

        <form action="{{ route('admin.messages.store') }}" method="POST" class="space-y-4 max-w-lg">
            @csrf

            <div>
                <label for="receiver_id" class="block text-sm font-medium">Destinataire</label>
                <select id="receiver_id" name="receiver_id" class="w-full border rounded px-3 py-2" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium">Message</label>
                <textarea id="content" name="content" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            <button type="submit"
                class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 focus:ring-2 focus:ring-pink-400">
                Envoyer
            </button>
        </form>
    </main>
@endsection
