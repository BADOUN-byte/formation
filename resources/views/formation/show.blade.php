@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Détails de la formation</h1>

    <div class="mb-3">
        <p><strong>Titre :</strong> {{ $formation->titre }}</p>
        <p><strong>Type :</strong> {{ $formation->type }}</p>
        <p><strong>Lieu :</strong> {{ $formation->lieu }}</p>
        <p><strong>Date début :</strong> {{ $formation->date_debut->format('d/m/Y') }}</p>
        <p><strong>Date fin :</strong> {{ $formation->date_fin->format('d/m/Y') }}</p>
        <p><strong>Volume horaire :</strong> {{ $formation->volume_horaire }} heures</p>
        <p><strong>Service :</strong> {{ optional($formation->service)->nom ?? 'N/A' }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($formation->statut ?? 'N/A') }}</p>
        <p><strong>Formateur :</strong> 
            {{ optional($formation->formateur)->nom }} 
            {{ optional($formation->formateur)->prenom }}
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

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('formations.index') }}" class="btn btn-secondary">← Retour à la liste</a>

        <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-warning">✏️ Modifier</a>

        <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
        </form>
    </div>
</div>
@endsection
