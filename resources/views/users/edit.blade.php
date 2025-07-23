@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4">Modifier l'utilisateur</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de mise à jour --}}
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $user->nom) }}" required>
        </div>

        {{-- Prénom --}}
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom *</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- Matricule --}}
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" name="matricule" id="matricule" class="form-control" value="{{ old('matricule', $user->matricule) }}">
        </div>

        {{-- Grade --}}
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade', $user->grade) }}">
        </div>

        {{-- Fonction --}}
        <div class="mb-3">
            <label for="fonction" class="form-label">Fonction</label>
            <input type="text" name="fonction" id="fonction" class="form-control" value="{{ old('fonction', $user->fonction) }}">
        </div>

        {{-- Rôle --}}
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle *</label>
            <select name="role_id" id="role_id" class="form-select" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->nom) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Service --}}
        <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select name="service_id" id="service_id" class="form-select">
                <option value="">-- Aucun --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $user->service_id) == $service->id ? 'selected' : '' }}>
                        {{ $service->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Mot de passe --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6">
        </div>

        {{-- Boutons --}}
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Mettre à jour
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection
