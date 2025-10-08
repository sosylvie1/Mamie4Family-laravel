@extends('layouts.admin')

@section('title', 'Tableau de bord Admin | Mamie4Family')
@section('description', 'Espace d’administration de Mamie4Family. Vue d’ensemble des familles, mamies et messages.')

@section('admin-content')
<main role="main" aria-labelledby="page-title">
    <h1 id="page-title" class="text-3xl font-bold mb-6">📊 Tableau de bord Admin</h1>

    {{-- ✅ Messages flash --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Section statistiques --}}
    <section aria-label="Statistiques principales">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Nombre de familles --}}
            <div class="bg-white shadow rounded p-6 text-center">
                <p class="text-gray-500 text-sm">Familles</p>
                <p class="text-3xl font-bold text-pink-600">{{ $famillesCount }}</p>
                <a href="{{ route('admin.familles.index') }}"
                   class="inline-block mt-2 px-3 py-1 text-sm bg-pink-600 text-white rounded hover:bg-pink-700 focus:ring-2 focus:ring-pink-400"
                   aria-label="Voir toutes les familles">Voir ➜</a>
            </div>

            {{-- Nombre de mamies --}}
            <div class="bg-white shadow rounded p-6 text-center">
                <p class="text-gray-500 text-sm">Mamies</p>
                <p class="text-3xl font-bold text-purple-600">{{ $mamiesCount }}</p>
                <a href="{{ route('admin.mamies.index') }}"
                   class="inline-block mt-2 px-3 py-1 text-sm bg-purple-600 text-white rounded hover:bg-purple-700 focus:ring-2 focus:ring-purple-400"
                   aria-label="Voir toutes les mamies">Voir ➜</a>
            </div>

            {{-- Nombre de messages --}}
            <div class="bg-white shadow rounded p-6 text-center">
                <p class="text-gray-500 text-sm">Messages</p>
                <p class="text-3xl font-bold text-blue-600">{{ $messagesCount }}</p>
                <a href="{{ route('admin.messages.index') }}"
                   class="inline-block mt-2 px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-400"
                   aria-label="Voir tous les messages">Voir ➜</a>
            </div>

            {{-- Nombre total d’utilisateurs --}}
            <div class="bg-white shadow rounded p-6 text-center">
                <p class="text-gray-500 text-sm">Utilisateurs</p>
                <p class="text-3xl font-bold text-green-600">{{ $usersCount }}</p>
                <a href="{{ route('admin.users.index') }}"
                   class="inline-block mt-2 px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 focus:ring-2 focus:ring-green-400"
                   aria-label="Voir tous les utilisateurs">Voir ➜</a>
            </div>
        </div>
    </section>

    {{-- ✅ Section derniers inscrits --}}
<section class="mt-10" aria-labelledby="last-users-title">
    <h2 id="last-users-title" class="text-xl font-semibold mb-4 text-marron-fonce">
        🆕 Derniers inscrits
    </h2>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full" role="table" aria-describedby="last-users-title">
            <thead class="bg-caramel-pastel text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 text-left">Nom</th>
                    <th scope="col" class="px-4 py-2 text-left">Email</th>
                    <th scope="col" class="px-4 py-2 text-left">Rôle</th>
                    <th scope="col" class="px-4 py-2 text-left">Date d’inscription</th>
                    <th scope="col" class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($latestUsers as $user)
                    <tr class="border-b hover:bg-gray-50 focus-within:bg-gray-50 transition">
                        {{-- Nom --}}
                        <td class="px-4 py-2 font-medium text-gray-800">{{ $user->name }}</td>

                        {{-- Email --}}
                        <td class="px-4 py-2 text-gray-700">{{ $user->email }}</td>

                        {{-- Rôle --}}
                        <td class="px-4 py-2 capitalize text-gray-700">{{ $user->role }}</td>

                        {{-- Date --}}
                        <td class="px-4 py-2 text-gray-600">
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-2 text-center space-x-2">
                            @if($user->role === 'mamie' && $user->mamieProfile)
                                <a href="{{ route('admin.mamies.show', $user->mamieProfile->id) }}"
                                   class="text-caramel hover:text-caramel-fonce focus:ring focus:ring-caramel rounded"
                                   title="Voir le profil de {{ $user->name }}">
                                    👁️
                                </a>
                                <a href="{{ route('admin.mamies.edit', $user->mamieProfile->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 focus:ring focus:ring-yellow-400 rounded"
                                   title="Modifier le profil de {{ $user->name }}">
                                    ✏️
                                </a>
                            @elseif($user->role === 'famille' && $user->familleProfile)
                                <a href="{{ route('admin.familles.show', $user->familleProfile->id) }}"
                                   class="text-caramel hover:text-caramel-fonce focus:ring focus:ring-caramel rounded"
                                   title="Voir le profil de {{ $user->name }}">
                                    👁️
                                </a>
                                <a href="{{ route('admin.familles.edit', $user->familleProfile->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 focus:ring focus:ring-yellow-400 rounded"
                                   title="Modifier le profil de {{ $user->name }}">
                                    ✏️
                                </a>
                            @else
                                <span class="text-gray-400" title="Aucune action disponible">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                            Aucun utilisateur récent
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>


    {{-- ✅ Section derniers messages --}}
    <section class="mt-10" aria-label="Derniers messages">
        <h2 class="text-xl font-semibold mb-4">📬 Derniers messages</h2>
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full" role="table">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-4 py-2">Expéditeur</th>
                        <th scope="col" class="px-4 py-2">Destinataire</th>
                        <th scope="col" class="px-4 py-2">Extrait</th>
                        <th scope="col" class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestMessages as $message)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $message->sender->name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $message->receiver->name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ Str::limit($message->content, 40) }}</td>
                            <td class="px-4 py-2">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun message récent</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
