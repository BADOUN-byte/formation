@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Directions</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDirectionModal">
            <i class="fas fa-plus-circle me-1"></i> Ajouter une direction
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @php
    $bgColors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info',
        'dark', 'success', 'primary-subtle', 'success-subtle', 'warning-subtle', 'danger-subtle', 'info-subtle'
    ];

    // Fonction pour déterminer si le texte doit être sombre ou clair
    function textColor($bgColor) {
        return in_array($bgColor, ['light', 'warning', 'info', 'success-subtle', 'warning-subtle', 'info-subtle', 'primary-subtle']) 
            ? 'text-dark' 
            : 'text-white';
    }
    @endphp
    $bgColors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info',
        'dark', 'success', 'primary-subtle', 'success-subtle', 'warning-subtle', 'danger-subtle', 'info-subtle'
    ];

    // Fonction pour déterminer si le texte doit être sombre ou clair
    function textColor($bgColor) {
        return in_array($bgColor, ['warning', 'info', 'success-subtle', 'warning-subtle', 'info-subtle', 'primary-subtle']) 
            ? 'text-dark' 
            : '';
    }
@endphp

<div class="row">
    @forelse($directions as $index => $direction)
        @php
            $bgColor = $bgColors[$index % count($bgColors)];
        @endphp
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card text-white bg-{{ $bgColor }} shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $direction->name }}</h5>
                </div>
                
                <div class="card-footer d-flex justify-content-between bg-transparent border-0">
                    <a href="{{ route('directions.edit', $direction->id) }}" class="text-white" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('directions.destroy', $direction->id) }}" method="POST" onsubmit="return confirm('Supprimer cette direction ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-white p-0 m-0" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Aucune direction enregistrée.</div>
        </div>
    @endforelse
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="createDirectionModal" tabindex="-1" aria-labelledby="createDirectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle direction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('directions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
@error('name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
