@extends('layouts.app')

@section('title', 'Créer un rôle')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h2 class="mb-4">Créer un nouveau rôle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur(s) :</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du rôle <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
