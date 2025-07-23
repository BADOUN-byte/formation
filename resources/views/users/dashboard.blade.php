@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORMATEUR --}}
    @if(auth()->user()->role_id === \App\Models\Role::FORMATEUR)
        <h2 class="mb-4">Tableau de bord Formateur</h2>

        <h4>Mes formations</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Titre</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formations as $formation)
                        <tr>
                            <td>{{ $formation->titre }}</td>
                            <td>{{ $formation->service?->nom ?? 'N/A' }}</td>
                            <td>{{ $formation->date ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('formateur.formations.show', $formation->id) }}" class="btn btn-sm btn-secondary">Voir</a>
                                <a href="{{ route('formateur.formations.edit', $formation->id) }}" class="btn btn-sm btn-info">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- PARTICIPANT --}}
    @if(auth()->user()->role_id === \App\Models\Role::PARTICIPANT)
        <h2 class="mb-4">Tableau de bord Participant</h2>

        <h4>Mes formations</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Titre</th>
                        <th>Formateur</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Attestation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formations as $formation)
                        <tr>
                            <td>{{ $formation->titre }}</td>
                            <td>{{ $formation->formateur?->nom ?? 'N/A' }}</td>
                            <td>{{ $formation->date ?? 'N/A' }}</td>
                            <td>{{ $formation->pivot->statut ?? 'Inscrit' }}</td>
                            <td>
                                @if(isset($formation->pivot->attestation) && $formation->pivot->attestation)
                                    <a href="{{ route('participant.attestations.show', $formation->pivot->attestation->id) }}" class="btn btn-sm btn-success">Télécharger</a>
                                @else
                                    <span class="text-muted">Non disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
