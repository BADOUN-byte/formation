@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Liste des utilisateurs</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                     <td>{{ $user->nom }} {{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->nom ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Modifier</a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun utilisateur trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
