@extends('layouts.app')

@section('title', 'Services de la direction ' . $direction->nom)

@section('content')
    <div class="container">

        <h2 class="mb-4">Services de la direction : {{ $direction->nom }}</h2>

        <!-- bouton ajouter un service -->
        <a href="{{ route('admin.services.create', ['direction_id' => $direction->id]) }}" class="btn btn-primary mb-3">
            ➕ Ajouter un service
        </a>

        <!-- messages d'alerte -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- tableau des services -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du service</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($direction->services as $service)
                    <tr>
                        <td>{{ $service->nom }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            <!-- bouton modifier -->
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                ✏️ Modifier
                            </a>
                            <!-- bouton supprimer -->
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline-block;"
                                  onsubmit="return confirm('Confirmer la suppression de ce service ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun service pour cette direction.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('admin.directions.index') }}" class="btn btn-secondary mt-3">⬅️ Retour aux directions</a>

    </div>
@endsection
