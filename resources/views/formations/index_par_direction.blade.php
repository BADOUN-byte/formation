@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        Formations de la direction :
        <span class="text-primary">{{ $direction->nom }}</span>
    </h2>

    {{-- Liste des services de la direction --}}
    @if ($direction->services && $direction->services->count())
        <div class="mb-4">
            <h4 class="text-secondary">Services de cette direction :</h4>
            <ul class="list-group">
                @foreach ($direction->services as $service)
                    <li class="list-group-item">
                        <strong>{{ $service->nom }}</strong>
                        {{-- Tu peux ajouter ici un lien pour filtrer les formations par service si nécessaire --}}
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-warning">
            Aucun service trouvé pour cette direction.
        </div>
    @endif

    {{-- Liste des formations --}}
    @if ($formations->count())
        <div class="list-group mb-4">
            @foreach ($formations as $formation)
                <a href="{{ route('admin.formations.show', $formation->id) }}" class="list-group-item list-group-item-action shadow-sm">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-dark">{{ $formation->titre }}</h5>
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}
                        </small>
                    </div>
                    <p class="mb-1 text-secondary">
                        <strong>Type :</strong> {{ $formation->type }}<br>
                        <strong>Lieu :</strong> {{ $formation->lieu }}<br>
                        <strong>Formateur :</strong> {{ optional($formation->formateur)->name ?? 'N/A' }}<br>
                        <strong>Service :</strong> {{ optional($formation->service)->nom ?? 'N/A' }}
                    </p>
                </a>
            @endforeach
        </div>

        @if (method_exists($formations, 'links'))
            <div class="d-flex justify-content-center">
                {{ $formations->links() }}
            </div>
        @endif
    @else
        <div class="alert alert-info">
            Aucune formation trouvée pour cette direction.
        </div>
    @endif

    <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary mt-3">
        ← Retour à toutes les formations
    </a>
</div>
@endsection
