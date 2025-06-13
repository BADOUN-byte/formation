@extends('layouts.app')

@section('title', 'Bienvenue')

@section('content')
<div class="container">
    <h1 class="text-center my-4 text-primary">Bienvenue sur la plateforme de gestion des formations</h1>

    {{-- SECTION DGTI --}}
    <div class="mb-5 p-4 bg-info text-white rounded">
        <h2 class="text-uppercase">📂 DGTI</h2>
        <ul class="list-group list-group-flush">
            @forelse($directions as $direction)
                <li class="list-group-item">
                    <strong>{{ $direction->nom ?? 'Aucune direction' }}</strong>

                    @if($direction->services && $direction->services->isNotEmpty())
                        <ul class="ms-4 mt-2">
                            @foreach($direction->services as $service)
                                <li>
                                    <span class="text-success">{{ $service->nom }}</span>

                                    @if($service->formations && $service->formations->isNotEmpty())
                                        <ul class="ms-3">
                                            @foreach($service->formations as $formation)
                                                <li class="text-muted">
                                                    {{ $formation->titre }}
                                                    ({{ optional($formation->date_debut)->format('d/m/Y') }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <em class="text-muted">Aucune formation</em>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <em class="text-muted">Aucun service</em>
                    @endif
                </li>
            @empty
                <li class="list-group-item text-muted">Aucune direction disponible.</li>
            @endforelse
        </ul>
    </div>

    {{-- SECTION STATUT DES FORMATIONS --}}
    <div class="mb-5 p-4 bg-warning text-dark rounded">
        <h2 class="text-uppercase">📘 Statut des formations</h2>
        <ul class="mb-0">
            <li>📘 Formations passées : {{ $formationsPassees }}</li>
            <li>📗 Formations en cours : {{ $formationsEnCours }}</li>
            <li>📙 Formations à venir : {{ $formationsAVenir }}</li>
        </ul>
    </div>

    {{-- SECTION STATISTIQUES --}}
    <div class="mb-5 p-4 bg-success text-white rounded">
        <h2 class="text-uppercase">📊 Statistiques</h2>
        <p>Données sur les participations, taux de réussite, etc.</p>
    </div>

    {{-- SECTION COMMENTAIRES --}}
    <div class="card my-4">
        <div class="card-header">
            <i class="fas fa-comments me-1"></i> Derniers commentaires
        </div>
        <div class="card-body">
            @if($comments->isEmpty())
                <p>Aucun commentaire pour le moment.</p>
            @else
                <ul class="list-group mb-3">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ optional($comment->user)->prenom }} {{ optional($comment->user)->nom }}</strong>
                            <small class="text-muted">le {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                            <p>{{ $comment->contenu }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

            @auth
                {{-- Formulaire ajout commentaire --}}
                <form method="POST" action="{{ route('commentaires.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="contenu" class="form-label">Ajouter un commentaire</label>
                        <textarea class="form-control @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="3" required>{{ old('contenu') }}</textarea>
                        @error('contenu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            @else
                <div class="alert alert-info mt-3">
                    <a href="{{ route('login') }}">Connectez-vous</a> pour laisser un commentaire.
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
