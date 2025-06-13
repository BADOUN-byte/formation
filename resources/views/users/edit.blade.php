@extends('layouts.app')

@section('content')
<h1>Modifier l'utilisateur</h1>

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required><br>

    <label>Prénom</label>
    <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" required><br>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>

    <label>Matricule</label>
    <input type="text" name="matricule" value="{{ old('matricule', $user->matricule) }}"><br>

    <label>Grade</label>
    <input type="text" name="grade" value="{{ old('grade', $user->grade) }}"><br>

    <label>Fonction</label>
    <input type="text" name="fonction" value="{{ old('fonction', $user->fonction) }}"><br>

    <label>Rôle</label>
    <select name="role_id" required>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                {{ $role->nom }}
            </option>
        @endforeach
    </select><br>

    <label>Service</label>
    <select name="service_id">
        <option value="">-- Aucun --</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ $user->service_id == $service->id ? 'selected' : '' }}>
                {{ $service->nom }}
            </option>
        @endforeach
    </select><br>

    <button type="submit">Mettre à jour</button>
</form>

<a href="{{ route('users.index') }}">← Retour</a>
@endsection
