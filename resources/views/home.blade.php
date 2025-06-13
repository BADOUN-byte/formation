@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Bienvenue {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h1>

    {{-- Déconnexion --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-2">Se déconnecter</button>
    </form>

    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Bienvenue sur la plateforme de gestion des formations de la DGTI</li>
    </ol>

    {{-- Bloc directions --}}
    @php
        $directions = [
            ['DGTI', 'primary'],
            ['DT', 'warning'],
            ['DSI', 'success'],
            ['DIG', 'danger'],
            ['DASP', 'warning'],
            ['DSEF', 'danger'],
        ];
    @endphp

    <div class="row mb-4">
        @foreach($directions as [$direction, $color])
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-{{ $color }} text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Formations {{ $direction }}</h5>
                        <p class="card-text">Accédez aux formations disponibles dans la direction {{ $direction }}.</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('formations.' . strtolower($direction) . '.index') }}">
                            Voir les formations
                        </a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Statistiques --}}
    <div class="row mb-4">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header"><i class="fas fa-chart-area me-1"></i>Statistiques des formations</div>
                <div class="card-body">
                    <canvas id="formationsChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header"><i class="fas fa-chart-bar me-1"></i>Participation aux formations</div>
                <div class="card-body">
                    <canvas id="participationChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Utilisateurs --}}
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users me-1"></i>Utilisateurs inscrits</div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->nom ?? 'Non défini' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Commentaires --}}
    <div class="card my-4">
        <div class="card-header"><i class="fas fa-comments me-1"></i>Derniers commentaires</div>
        <div class="card-body">
            @if($comments->isEmpty())
                <p>Aucun commentaire pour le moment.</p>
            @else
                <ul class="list-group mb-3">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->prenom }} {{ $comment->user->nom }}</strong>
                            <small class="text-muted">le {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                            <p>{{ $comment->contenu }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

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
        </div>
    </div>
</div>
@endsection
