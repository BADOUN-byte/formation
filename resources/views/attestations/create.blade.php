@extends('layouts.app')

@section('content')
<h1>Ajouter une attestation</h1>

<form method="POST" action="{{ route('attestations.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Utilisateur :</label>
    <select name="user_id" required>
        <option value="">-- Sélectionner --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
        @endforeach
    </select><br>

    <label>Formation :</label>
    <select name="formation_id" required>
        <option value="">-- Sélectionner --</option>
        @foreach($formations as $formation)
            <option value="{{ $formation->id }}">{{ $formation->type }}</option>
        @endforeach
    </select><br>

    <label>Date d’émission :</label>
    <input type="date" name="date_emission" required><br>

    <label>Fichier PDF :</label>
    <input type="file" name="fichier_pdf" accept="application/pdf" required><br>

    <button type="submit">Enregistrer</button>
</form>

<a href="{{ route('attestations.index') }}">← Retour</a>
@endsection
