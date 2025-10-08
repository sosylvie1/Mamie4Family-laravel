@extends('layouts.admin')

@section('title', 'Créer un utilisateur - Admin | Mamie4Family')
@section('description', 'Formulaire Admin pour ajouter un nouvel utilisateur (famille, mamie ou admin).')

@section('admin-content')
    <main role="main" aria-labelledby="page-title">
        <h1 id="page-title" class="text-2xl font-bold mb-4">➕ Ajouter un utilisateur</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 max-w-lg">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Nom</label>
                <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium">Rôle</label>
                <select id="role" name="role" class="w-full border rounded px-3 py-2" required>
                    <option value="famille">Famille</option>
                    <option value="mamie">Mamie</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit"
                class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 focus:ring-2 focus:ring-pink-400">
                Créer
            </button>
        </form>
    </main>
@endsection
