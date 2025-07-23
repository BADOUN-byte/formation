@extends('layouts.app')

@section('title', 'Modifier le service')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded p-4 bg-light">
        <h2 class="fw-bold mb-4 text-primary">
            ✏️ Modifier le service
        </h2>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label for="nom" class="form-label">Nom du service</label>
                <input
                    type="text"
                    name="nom"
                    id="nom"
                    class="form-control @error('nom') is-invalid @enderror"
                    value="{{ old('nom', $service->nom) }}"
                    required
                >
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="direction_id" class="form-label">Direction associée</label>
                <select
                    name="direction_id"
                    id="direction_id"
                    class="form-select @error('direction_id') is-invalid @enderror"
                    required
                >
                    @foreach($directions as $direction)
                        <option value="{{ $direction->id }}"
                            {{ old('direction_id', $service->direction_id) == $direction->id ? 'selected' : '' }}>
                            {{ $direction->nom }}
                        </option>
                    @endforeach
                </select>
                @error('direction_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="3"
                >{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
