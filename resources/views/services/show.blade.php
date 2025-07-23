@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du service</h1>

    <div class="card mb-3">
        <div class="card-header">
            <strong>{{ $service->nom }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Description :</strong> {{ $service->description ?? 'Aucune description' }}</p>
            <p><strong>Direction :</strong> {{ $service->direction->nom }}</p>
        </div>
    </div>

    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">← Retour à la liste des services</a>
</div>
@endsection
