@extends('layouts.admin')

@section('title', 'Modifier un utilisateur - Admin | Mamie4Family')
@section('description', "Formulaire Admin pour modifier l’utilisateur {$user->name}.")

@section('admin-content')
    <main role="main" aria-labelledby="page-title">
        <h1 id="page-title" class="text-2xl font-bold mb-4">✏️ Modifier utilisateur</h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4 max-w-lg">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Mot de passe (laisser vide si inchangé)</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium">Rôle</label>
                <select id="role" name="role" class="w-full border rounded px-3 py-2" required>
                    <option value="famille" @selected($user->role === 'famille')>Famille</option>
                    <option value="mamie" @selected($user->role === 'mamie')>Mamie</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
            </div>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                Mettre à jour
            </button>
        </form>
    </main>
@endsection
