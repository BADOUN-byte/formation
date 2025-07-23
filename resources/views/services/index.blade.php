@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">📂 Liste des services</h1>
        <div>
            <a href="{{ route('admin.directions.index') }}" class="btn btn-secondary me-2">← Retour aux directions</a>
            <a href="{{ route('admin.services.create') }}" class="btn btn-success">➕ Ajouter un service</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @isset($direction)
        <div class="alert alert-info mb-3">
            Services filtrés par la direction : <strong>{{ $direction->nom }}</strong>
        </div>
    @endisset

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Direction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $service->nom }}</td>
                        <td>{{ Str::limit(strip_tags($service->description), 100) }}</td>
                        <td>{{ $service->direction->nom ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.services.show', $service) }}" class="btn btn-info btn-sm me-1">👁️</a>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-sm me-1">✏️</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Confirmer la suppression de ce service ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucun service à afficher.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $services->links() }}
    </div>
</div>
@endsection
