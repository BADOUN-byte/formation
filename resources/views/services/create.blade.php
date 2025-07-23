@extends('layouts.app')

@section('title', 'Ajouter un service')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded p-4 bg-light">
        <h2 class="fw-bold mb-4 text-primary">
            ➕ Ajouter un service
        </h2>

        <form 
            action="{{ isset($direction) 
                        ? route('admin.directions.services.store', $direction) 
                        : route('admin.services.store') 
                    }}" 
            method="POST"
            class="row g-3"
        >
            @csrf

            <div class="col-md-6">
                <label for="nom" class="form-label">Nom du service</label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom') }}" 
                       required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if(isset($direction))
                <div class="col-md-6">
                    <label class="form-label">Direction</label>
                    <input type="text" class="form-control" value="{{ $direction->nom }}" disabled>
                    <input type="hidden" name="direction_id" value="{{ $direction->id }}">
                </div>
            @else
                <div class="col-md-6">
                    <label for="direction_id" class="form-label">Direction</label>
                    <select name="direction_id" 
                            id="direction_id"
                            class="form-select @error('direction_id') is-invalid @enderror"
                            required>
                        <option value="">-- Choisir une direction --</option>
                        @foreach($directions as $dir)
                            <option value="{{ $dir->id }}"
                                    {{ old('direction_id') == $dir->id ? 'selected' : '' }}>
                                {{ $dir->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('direction_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control @error('description') is-invalid @enderror"
                    rows="3"
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
                <a href="{{ isset($direction) 
                        ? route('admin.directions.services.index', $direction) 
                        : route('admin.services.index') 
                    }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
