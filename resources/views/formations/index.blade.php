@extends('layouts.app')

@section('content')
    <h1>Liste des formations</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
    @if(auth()->user()->role_id === \App\Models\Role::ADMIN || auth()->user()->role_id === \App\Models\Role::FORMATEUR)
        <a href="{{ route('admin.formations.create') }}" class="btn btn-primary">Créer une formation</a>
    @endif
@endauth


    <ul>
        @forelse ($formations as $formation)
            <li>
                <a href="{{ route('admin.formations.show', $formation->id) }}">
                    <strong>{{ $formation->titre }}</strong> — 
                    {{ $formation->type }} — 
                    {{ $formation->lieu }} — 
                    Du {{ optional($formation->date_debut)->format('d/m/Y') }} 
                    au {{ optional($formation->date_fin)->format('d/m/Y') }}
                </a>
                (Formateur : {{ optional($formation->formateur)->nom ?? 'N/A' }})
            </li>
        @empty
            <li>Aucune formation disponible.</li>
        @endforelse
    </ul>

    <div class="mt-4">
        {{ $formations->links() }}
    </div>
@endsection
