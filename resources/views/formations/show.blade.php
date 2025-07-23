@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">Détails de la formation</h1>

    <div class="card p-3 mb-4 shadow-sm">
        <p><strong>Titre :</strong> {{ $formation->titre }}</p>
        <p><strong>Type :</strong> {{ $formation->type }}</p>
        <p><strong>Lieu :</strong> {{ $formation->lieu }}</p>
        <p><strong>Date début :</strong> {{ $formation->date_debut->format('d/m/Y') }}</p>
        <p><strong>Date fin :</strong> {{ $formation->date_fin->format('d/m/Y') }}</p>
        <p><strong>Volume horaire :</strong> {{ $formation->volume_horaire }} heures</p>
        <p><strong>Service :</strong> {{ optional($formation->service)->nom ?? 'N/A' }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($formation->statut ?? 'N/A') }}</p>
        <p><strong>Formateur :</strong> 
            {{ optional($formation->formateur)->nom ?? 'N/A' }} 
            {{ optional($formation->formateur)->prenom ?? '' }}
        </p>
    </div>

    <h4>Participants</h4>
    @if($formation->participants->isEmpty())
        <p class="text-muted">Aucun participant inscrit.</p>
    @else
        <ul>
            @foreach ($formation->participants as $participant)
                <li>{{ $participant->nom }} {{ $participant->prenom }}</li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4 d-flex flex-wrap gap-2 align-items-center">

        {{-- bouton retour --}}
        <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary">
            ← Retour à la liste
        </a>

        @auth
            @php $user = auth()->user(); @endphp

            {{-- actions ADMIN --}}
            @if($user->role_id === \App\Models\Role::ADMIN)
                <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-warning">
                    ✏️ Modifier
                </a>

                <form action="{{ route('admin.formations.destroy', $formation->id) }}" method="POST"
                      onsubmit="return confirm('Confirmer la suppression ?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                </form>
            @endif

            {{-- actions FORMATEUR --}}
            @if($user->role_id === \App\Models\Role::FORMATEUR)
                <a href="{{ route('admin.formations.participants.add', $formation->id) }}" class="btn btn-primary">
                    ➕ Ajouter des participants
                </a>
            @endif

            {{-- actions PARTICIPANT --}}
            @if($user->role_id === \App\Models\Role::PARTICIPANT)
                <form method="POST" action="{{ route('admin.formations.inscription', $formation->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        S'inscrire
                    </button>
                </form>

                <a href="{{ route('formations.commentaires', $formation->id) }}" class="btn btn-secondary">
                    💬 Commenter
                </a>
            @endif

        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                Connectez-vous pour voir les actions
            </a>
        @endauth
    </div>

</div>
@endsection
