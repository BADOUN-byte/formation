@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter une formation pour {{ $user->nom }} {{ $user->prenom }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('users.formations.attach', $user) }}">
        @csrf

        <div class="mb-3">
            <label for="formation_id" class="form-label">Formation</label>
            <select name="formation_id" id="formation_id" class="form-control" required>
                <option value="">-- Sélectionner une formation --</option>
                @foreach($formations as $formation)
                    <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                @endforeach
            </select>
            @error('formation_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role_in_formation" class="form-label">Rôle dans la formation</label>
            <select name="role_in_formation" id="role_in_formation" class="form-control" required>
                <option value="">-- Choisir un rôle --</option>
                <option value="formateur">Formateur</option>
                <option value="participant">Participant</option>
            </select>
            @error('role_in_formation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la formation</button>
    </form>

    @if($formationsAssociees->count())
        <hr>
        <h4 class="mt-4">Formations déjà associées :</h4>
        <ul class="list-group mt-2">
            @foreach($formationsAssociees as $formation)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $formation->titre }}
                    <span class="badge bg-secondary">
                        {{ ucfirst($formation->pivot->role_in_formation) }}
                    </span>
                </li>
            @endforeach
        </ul>

        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $formationsAssociees->links() }}
        </div>
    @else
        <p class="text-muted mt-3">Aucune formation associée.</p>
    @endif
</div>
@endsection
