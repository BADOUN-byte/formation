@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        Formations de la direction : 
        <span class="text-primary">{{ $direction->nom }}</span>
    </h2>

    @if ($formations->count())
        <div class="list-group mb-4">
            @foreach ($formations as $formation)
                <a href="{{ route('formations.show', $formation->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $formation->titre }}</h5>
                        <small>{{ $formation->date_debut->format('d/m/Y') }} - {{ $formation->date_fin->format('d/m/Y') }}</small>
                    </div>
                    <p class="mb-1">
                        <strong>Type :</strong> {{ $formation->type }}<br>
                        <strong>Lieu :</strong> {{ $formation->lieu }}<br>
                        <strong>Formateur :</strong> {{ optional($formation->formateur)->nom ?? 'N/A' }}
                    </p>
                </a>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $formations->links() }}
        </div>
    @else
        <div class="alert alert-info">
            Aucune formation trouvée pour cette direction.
        </div>
    @endif

    <a href="{{ route('formations.index') }}" class="btn btn-secondary mt-3">
        ← Retour à toutes les formations
    </a>
</div>
@endsection
