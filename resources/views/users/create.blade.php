@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4">Créer un nouvel utilisateur</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs détectées :</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de création --}}
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        {{-- Nom --}}
        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        {{-- Prénom --}}
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom *</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        {{-- Mot de passe --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe *</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>

        {{-- Matricule --}}
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" name="matricule" id="matricule" class="form-control" value="{{ old('matricule') }}">
        </div>

        {{-- Grade --}}
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade') }}">
        </div>

        {{-- Fonction --}}
        <div class="mb-3">
            <label for="fonction" class="form-label">Fonction</label>
            <input type="text" name="fonction" id="fonction" class="form-control" value="{{ old('fonction') }}">
        </div>

        {{-- Rôle --}}
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle *</label>
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="">-- Sélectionner un rôle --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->nom) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Service --}}
        <div class="mb-4">
            <label for="service_id" class="form-label">Service (optionnel)</label>
            <select name="service_id" id="service_id" class="form-select">
                <option value="">-- Aucun --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Boutons --}}
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Créer
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection
