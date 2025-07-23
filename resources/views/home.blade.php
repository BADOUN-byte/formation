@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="py-6 px-4 max-w-7xl mx-auto">

    {{-- Message de bienvenue --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-blue-800 uppercase">Bienvenue {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h1>
        <p class="text-sm text-gray-600 mt-2">Rôle : <span class="font-semibold text-blue-700">{{ Auth::user()->role->nom ?? 'Utilisateur' }}</span></p>

        {{-- Déconnexion --}}
        <form method="POST" action="{{ route('logout') }}" class="inline-block mt-3">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-4 py-1 rounded">Se déconnecter</button>
        </form>
    </div>

    {{-- Formations par Direction --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($directions as $direction)
            <div class="border border-blue-300 rounded-lg shadow bg-white">
                <div class="bg-blue-700 text-white px-4 py-2 rounded-t-md font-semibold">
                    📚 Formations - {{ $direction->nom }}
                </div>
                <div class="p-4">
                    <p class="text-gray-700 mb-3">
                        Accédez aux formations disponibles dans la direction <strong>{{ $direction->nom }}</strong>.
                    </p>
                    <a href="{{ route('formations.direction.index', $direction->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded inline-block text-sm">
                        Voir les formations
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Utilisateurs inscrits --}}
    <div class="bg-white rounded-lg shadow mb-10">
        <div class="bg-gray-800 text-white px-4 py-2 rounded-t-md font-semibold">
            👥 Utilisateurs inscrits
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Nom</th>
                        <th class="px-4 py-2 text-left">Prénom</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Rôle</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->nom }}</td>
                            <td class="px-4 py-2">{{ $user->prenom }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 uppercase">{{ $user->role->nom ?? 'Non défini' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>

    {{-- Commentaires récents --}}
    <div class="bg-white rounded-lg shadow">
        <div class="bg-blue-500 text-white px-4 py-2 rounded-t-md font-semibold">
            💬 Derniers commentaires
        </div>
        <div class="p-4">
            @forelse($comments as $comment)
                <div class="border-b border-gray-200 pb-3 mb-3">
                    <div class="text-sm text-gray-800 font-semibold">
                        {{ $comment->user->prenom ?? 'Utilisateur' }} {{ $comment->user->nom ?? '' }}
                        <span class="text-xs text-gray-500 ml-2">
                            le {{ $comment->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <p class="text-gray-700 text-sm mt-1">{{ $comment->contenu }}</p>
                </div>
            @empty
                <p class="text-gray-500">Aucun commentaire pour le moment.</p>
            @endforelse

            {{-- Formulaire commentaire --}}
            @auth
                <form action="{{ route('commentaires.store') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="contenu" class="block text-gray-700 font-medium mb-1">Ajouter un commentaire</label>
                        <textarea name="contenu" id="contenu" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-400 @error('contenu') border-red-500 @enderror">{{ old('contenu') }}</textarea>
                        @error('contenu')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold px-4 py-2 rounded">
                        Envoyer
                    </button>
                </form>
            @else
                <div class="mt-4 text-yellow-700 bg-yellow-100 p-3 rounded">
                    <a href="{{ route('login') }}" class="underline font-semibold">Connectez-vous</a> pour laisser un commentaire.
                </div>
            @endauth
        </div>
    </div>

</div>
@endsection
