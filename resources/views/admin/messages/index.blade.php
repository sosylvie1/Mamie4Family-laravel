@extends('layouts.admin')

@section('title', 'Messages reçus | Mamie4Family')
@section('description', 'Liste des messages envoyés via le formulaire ou entre utilisateurs.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="max-w-6xl mx-auto py-6">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-6">📩 Messages</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-caramel-pastel">
            <thead class="bg-caramel-pastel text-marron-fonce">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Expéditeur</th>
                    <th class="px-4 py-2 text-left">Destinataire</th>
                    <th class="px-4 py-2 text-left">Message</th>
                    <th class="px-4 py-2 text-left">Statut</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $message->id }}</td>
                        <td class="px-4 py-2">{{ $message->sender_name }}</td>
                        <td class="px-4 py-2">{{ $message->receiver_name }}</td>
                        <td class="px-4 py-2">{{ Str::limit($message->content, 60) }}</td>
                        <td class="px-4 py-2">
                            {!! $message->is_read ? '<span class="text-green-600">✅ Lu</span>' : '<span class="text-red-600">📩 Non lu</span>' !!}
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.messages.show', $message->id) }}" 
                               class="text-blue-600 hover:underline">Voir</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('Supprimer ce message ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                            Aucun message reçu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</main>
@endsection
