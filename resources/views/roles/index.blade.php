@extends('layouts.app')

@section('title', 'Liste des rôles')

@section('content')
<div class="container mt-4" style="max-width: 800px;">
    <h2 class="mb-4">Liste des rôles</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un rôle
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th>Nom</th>
                        <th style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->nom }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning me-2">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>

                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce rôle ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun rôle disponible.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
