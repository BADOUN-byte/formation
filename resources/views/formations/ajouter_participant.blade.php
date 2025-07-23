@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Ajouter un participant à la formation</h1>

    <div class="mb-3">
        <p><strong>Formation :</strong> {{ $formation->titre }}</p>
    </div>

    <form method="POST" action="{{ route('admin.formations.participants.store', $formation->id) }}">
        @csrf

        <div class="form-group mb-3">
            <label for="participant_id">Sélectionner un participant :</label>
            <select name="participant_id" id="participant_id" class="form-control" required>
                <option value="">-- Choisissez un participant --</option>
                @foreach($participants as $participant)
                    <option value="{{ $participant->id }}">
                        {{ $participant->nom }} {{ $participant->prenom }} ({{ $participant->email }})
                    </option>
                @endforeach
            </select>
            @error('participant_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('admin.formations.show', $formation->id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
