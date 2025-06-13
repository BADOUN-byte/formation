@extends('layouts.app')

@section('content')
<h1>Liste des utilisateurs</h1>

<a href="{{ route('users.create') }}">Créer un utilisateur</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Matricule</th>
            <th>Grade</th>
            <th>Fonction</th>
            <th>Rôle</th>
            <th>Service</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->matricule ?? '-' }}</td>
            <td>{{ $user->grade ?? '-' }}</td>
            <td>{{ $user->fonction ?? '-' }}</td>
            <td>{{ $user->role->nom ?? '-' }}</td>
            <td>{{ $user->service->nom ?? '-' }}</td>
            <td>
                <a href="{{ route('users.show', $user) }}">Voir</a>
                <a href="{{ route('users.edit', $user) }}">Modifier</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
