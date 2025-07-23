@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 700px;">
    <h1 class="mb-4">Détails de l'utilisateur</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td>{{ $user->nom }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Prénom</th>
                        <td>{{ $user->prenom }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Matricule</th>
                        <td>{{ $user->matricule ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Grade</th>
                        <td>{{ $user->grade ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Fonction</th>
                        <td>{{ $user->fonction ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Rôle</th>
                        <td>{{ $user->role->nom ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Service</th>
                        <td>{{ $user->service->nom ?? '—' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
