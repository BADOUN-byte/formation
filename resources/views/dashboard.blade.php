@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container-fluid px-4">
    {{-- Bienvenue & déconnexion --}}
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>Bienvenue {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Se déconnecter</button>
        </form>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Bienvenue sur la plateforme de gestion des formations de la DGTI</li>
    </ol>

    {{-- Bloc des directions --}}
    <div class="row mb-4">
    @foreach($directions as [$direction, $color])
        @php
            $slug = Str::slug($direction);
        @endphp
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-{{ $color }} text-white h-100">
                <div class="card-body">Formations {{ $direction }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('formations.direction.index', ['direction' => $slug]) }}">
                        Voir les formations
                    </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    {{-- Tableau des utilisateurs --}}
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users me-1"></i> Liste des utilisateurs de la plateforme</div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped table-bordered">
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
                                <td>{{ optional($user->role)->nom ?? 'Non défini' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Commentaires --}}
    <div class="card my-4">
        <div class="card-header"><i class="fas fa-comments me-1"></i> Derniers commentaires</div>
        <div class="card-body">
            @if($comments->isEmpty())
                <p class="text-muted">Aucun commentaire pour le moment.</p>
            @else
                <ul class="list-group mb-3">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ optional($comment->user)->prenom }} {{ optional($comment->user)->nom }}</strong>
                            <small class="text-muted d-block">le {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                            <p class="mb-0">{{ $comment->contenu }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- @include('partials.comment-form') --}}
        </div>
    </div>
</div>
@endsection
