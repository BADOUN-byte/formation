@extends('layouts.app')

@section('title', isset($direction) ? 'Services de ' . $direction->nom : 'Services')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📂 Services de la direction : {{ $direction->nom ?? '—' }}</h1>
        <a href="{{ route('admin.directions.index') }}" class="btn btn-secondary">← Retour aux directions</a>
    </div>

    @if ($services->count())
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->nom }}</td>
                            <td>{{ $service->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.services.show', $service) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-sm">Modifier</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $services->links() }}</div>
    @else
        <div class="alert alert-warning">Aucun service pour cette direction.</div>
    @endif
</div>
@endsection
