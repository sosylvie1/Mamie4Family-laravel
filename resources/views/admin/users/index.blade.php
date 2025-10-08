@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs - Admin | Mamie4Family')
@section('description', 'Tableau de bord Admin : liste et gestion de tous les utilisateurs (familles, mamies, admins).')

@section('admin-content')
<main role="main" aria-labelledby="page-title">
    <h1 id="page-title" class="text-2xl font-bold mb-4">👥 Gestion des utilisateurs</h1>

    <a href="{{ route('admin.users.create') }}"
       class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
       aria-label="Créer un nouvel utilisateur">
       ➕ Ajouter un utilisateur
    </a>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif
@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs - Admin | Mamie4Family')
@section('description', 'Tableau de bord Admin : liste et gestion de tous les utilisateurs (familles, mamies, admins).')

@section('admin-content')
<main role="main" aria-labelledby="page-title">
    <h1 id="page-title" class="text-2xl font-bold mb-4">👥 Gestion des utilisateurs</h1>

    <a href="{{ route('admin.users.create') }}"
       class="inline-block px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
       aria-label="Créer un nouvel utilisateur">
       ➕ Ajouter un utilisateur
    </a>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded" role="table">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-4 py-2 text-left">Nom</th>
                    <th scope="col" class="px-4 py-2 text-left">Email</th>
                    <th scope="col" class="px-4 py-2 text-left">Rôle</th>
                    <th scope="col" class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">
                        <a href="mailto:{{ $user->email }}" class="text-blue-600 underline">{{ $user->email }}</a>
                    </td>
                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-400"
                           aria-label="Modifier l’utilisateur {{ $user->name }}">✏️ Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                              onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:ring-2 focus:ring-red-400"
                                    aria-label="Supprimer l’utilisateur {{ $user->name }}">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <nav class="mt-4" role="navigation" aria-label="Pagination">
        {{ $users->links() }}
    </nav>
</main>
@endsection
