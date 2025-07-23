@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
@php
    $currentUser = Auth::user();
@endphp

<div class="container py-4 position-relative">
    {{-- Message de bienvenue --}}
    <div class="mb-4 text-center mt-5">
        <h1 class="display-3 text-primary fw-bold">
            BIENVENUE {{ $currentUser->prenom }} {{ $currentUser->nom }}
        </h1>
        <p class="lead text-secondary text-uppercase">
            Rôle : {{ $currentUser->role->nom ?? 'Utilisateur' }}
        </p>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger mt-2">🚪 Se déconnecter</button>
        </form>
    </div>

    @if($currentUser->isAdmin())

        {{-- === DIRECTIONS === --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>🏢 Directions</span>
                <a href="{{ route('admin.directions.create') }}" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($directions as $direction)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $direction->nom }}
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.directions.edit', $direction->id) }}" class="btn btn-outline-secondary">✏️</a>
                            <form action="{{ route('admin.directions.destroy', $direction->id) }}" method="POST" onsubmit="return confirm('Supprimer cette direction ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucune direction trouvée.</li>
                @endforelse
            </ul>
        </div>

        {{-- === SERVICES === --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>🧩 Services</span>
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($services as $service)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $service->nom }} <small class="text-muted">({{ $service->direction->nom }})</small>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-outline-secondary">✏️</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Supprimer ce service ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucun service trouvé.</li>
                @endforelse
            </ul>
        </div>

        {{-- === FORMATIONS === --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span>📅 Formations</span>
                <a href="{{ route('admin.formations.create') }}" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($formations as $formation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $formation->titre }} <small class="text-muted">({{ $formation->formateur->name ?? 'Sans formateur' }})</small>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-outline-secondary">✏️</a>
                            <form action="{{ route('admin.formations.destroy', $formation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette formation ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucune formation trouvée.</li>
                @endforelse
            </ul>
        </div>

        {{-- === UTILISATEURS === --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>👥 Utilisateurs</span>
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->prenom }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-uppercase">{{ $user->role->nom ?? 'Non défini' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-secondary">✏️</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">Aucun utilisateur trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    @endif

</div>
@endsection
