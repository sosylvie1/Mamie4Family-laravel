@extends('layouts.admin')

@section('title', 'Liste des Mamies | Administration Mamie4Family')
@section('description', 'Consultez et gérez les profils Mamies enregistrées sur Mamie4Family.')

@section('admin-content')
<main role="main" aria-labelledby="page-title" class="p-6">
    <h1 id="page-title" class="text-2xl font-bold text-marron-fonce mb-6">👵 Liste des Mamies</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Tableau responsive --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-caramel-pastel">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-caramel text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Ville</th>
                    <th class="px-4 py-3 text-left">Département</th>
                    <th class="px-4 py-3 text-left">Arrondissement</th>
                    <th class="px-4 py-3 text-left">Services</th>
                    <th class="px-4 py-3 text-left">Tarif net (€ / h)</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mamies as $mamie)
                    <tr class="border-t border-caramel-pastel hover:bg-caramel-pastel/20">
                        <td class="px-4 py-3 font-semibold">
                            {{ $mamie->user->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3">{{ $mamie->ville ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $mamie->departement ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $mamie->arrondissement ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $mamie->services ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $mamie->tarif ? $mamie->tarif . ' €' : '—' }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.mamies.show', $mamie->id) }}" class="text-blue-600 hover:underline">👁️ Voir</a>
                            <a href="{{ route('admin.mamies.edit', $mamie->id) }}" class="text-yellow-600 hover:underline">✏️ Modifier</a>

                            @if($mamie->cni)
                                <a href="{{ route('admin.mamies.downloadCni', $mamie->id) }}" class="text-green-600 hover:underline">📥 CNI</a>
                            @endif

                            <form action="{{ route('admin.mamies.destroy', $mamie->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce profil ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-600">
                            Aucune mamie enregistrée pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $mamies->links() }}
    </div>
</main>
@endsection
