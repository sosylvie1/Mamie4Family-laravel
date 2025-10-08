@extends('layouts.admin')

@section('title', 'Liste des Familles | Mamie4Family')
@section('description', 'Page d’administration listant toutes les familles inscrites avec leurs informations principales.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="p-6">
    <h1 id="page-title" class="text-2xl font-bold mb-4">👨‍👩‍👧 Liste des Familles</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border-collapse">
            <thead class="bg-caramel-pastel text-left">
                <tr>
                    <th class="p-3 font-semibold">Nom</th>
                    <th class="p-3 font-semibold">Email</th>
                    <th class="p-3 font-semibold">Ville</th>
                    <th class="p-3 font-semibold">Département</th>
                    <th class="p-3 font-semibold">Téléphone</th>
                    <th class="p-3 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($familles as $famille)
                    <tr class="border-b hover:bg-gray-50 focus-within:bg-gray-100">
                        <td class="p-3">{{ $famille->user->name }}</td>
                        <td class="p-3">{{ $famille->user->email }}</td>
                        <td class="p-3">{{ $famille->ville ?? '—' }}</td>
                        <td class="p-3">{{ $famille->departement ?? '—' }}</td>
                        <td class="p-3">{{ $famille->telephone ?? '—' }}</td>
                        <td class="p-3 text-center flex justify-center space-x-2">
                            <a href="{{ route('admin.familles.show', $famille->id) }}" class="text-blue-600 hover:underline" aria-label="Voir la famille {{ $famille->user->name }}">👁️</a>
                            <a href="{{ route('admin.familles.edit', $famille->id) }}" class="text-yellow-600 hover:underline" aria-label="Modifier la famille {{ $famille->user->name }}">✏️</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $familles->links() }}
    </div>
</main>
@endsection
