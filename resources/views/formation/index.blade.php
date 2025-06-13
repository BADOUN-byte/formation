@extends('layouts.app')

@section('content')
    <h1>Liste des formations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('formations.create') }}" class="btn btn-primary mb-3">Ajouter une formation</a>

    <ul>
        @forelse ($formations as $formation)
            <li>
                <a href="{{ route('formations.show', $formation->id) }}">
                    <strong>{{ $formation->titre }}</strong> — {{ $formation->type }} — {{ $formation->lieu }} — 
                    Du {{ $formation->date_debut->format('d/m/Y') }} 
                    au {{ $formation->date_fin->format('d/m/Y') }}
                </a>
                (Formateur : {{ optional($formation->formateur)->nom ?? 'N/A' }})
            </li>
        @empty
            <li>Aucune formation disponible.</li>
        @endforelse
    </ul>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $formations->links() }}
    </div>
@endsection
