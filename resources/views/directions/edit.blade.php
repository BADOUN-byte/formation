@extends('layouts.app')

@section('title', 'Modifier la direction')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary">✏️ Modifier une direction</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Affichage des erreurs --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.directions.update', $direction->id) }}" method="POST" class="border p-4 rounded shadow-sm bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la direction</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $direction->nom) }}" class="form-control @error('nom') is-invalid @enderror" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Décommente cette section uniquement si "description" existe dans ta table --}}
        {{-- <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $direction->description) }}</textarea>
        </div> --}}

        <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
        <a href="{{ route('admin.directions.index') }}" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
@endsection
