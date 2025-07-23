@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Commentaires des utilisateurs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulaire d'ajout de commentaire -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un commentaire</div>
        <div class="card-body">
            <form method="POST" action="{{ route('commentaires.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control @error('contenu') is-invalid @enderror" rows="4" required>{{ old('contenu') }}</textarea>
                    @error('contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Publier</button>
            </form>
        </div>
    </div>

    <!-- Liste des commentaires -->
    <div class="card">
        <div class="card-header">Tous les commentaires</div>
        <div class="card-body">
            @forelse($commentaires as $comment)
                <div class="border rounded p-3 mb-3">
                    <p>{{ $comment->contenu }}</p>
                    <small class="text-muted">
                        Posté par {{ $comment->user->prenom ?? 'Utilisateur inconnu' }} {{ $comment->user->nom ?? '' }}
                        le {{ $comment->created_at->format('d/m/Y à H:i') }}
                    </small>

                    @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('commentaires.destroy', $comment) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</button>
                        </form>
                    @endif
                </div>
            @empty
                <p>Aucun commentaire pour le moment.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
