@extends('layouts.app')

@section('content')
    <h1>Créer une formation</h1>

    <form action="{{ route('formations.store') }}" method="POST">
        @csrf

        <!-- Titre -->
        <label for="titre">Titre :</label>
        <input id="titre" type="text" name="titre" value="{{ old('titre') }}" required>
        @error('titre')<div class="error">{{ $message }}</div>@enderror

        <!-- Description -->
        <label for="description">Description :</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description')<div class="error">{{ $message }}</div>@enderror

        <!-- Type -->
        <label for="type">Type :</label>
        <select id="type" name="type" required>
            <option value="">-- Choisir un type --</option>
            @foreach(['Présentiel', 'En ligne', 'Hybride'] as $type)
                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
        @error('type')<div class="error">{{ $message }}</div>@enderror

        <!-- Date début -->
        <label for="date_debut">Date début :</label>
        <input id="date_debut" type="date" name="date_debut" value="{{ old('date_debut') }}" required>
        @error('date_debut')<div class="error">{{ $message }}</div>@enderror

        <!-- Date fin -->
        <label for="date_fin">Date fin :</label>
        <input id="date_fin" type="date" name="date_fin" value="{{ old('date_fin') }}" required>
        @error('date_fin')<div class="error">{{ $message }}</div>@enderror

        <!-- Lieu -->
        <label for="lieu">Lieu :</label>
        <input id="lieu" type="text" name="lieu" value="{{ old('lieu') }}" required>
        @error('lieu')<div class="error">{{ $message }}</div>@enderror

        <!-- Volume horaire -->
        <label for="volume_horaire">Volume horaire (heures) :</label>
        <input id="volume_horaire" type="number" name="volume_horaire" value="{{ old('volume_horaire') }}" min="1" required>
        @error('volume_horaire')<div class="error">{{ $message }}</div>@enderror

        <!-- Statut -->
        <label for="statut">Statut :</label>
        <select id="statut" name="statut">
            <option value="">-- Choisir un statut --</option>
            @foreach(['en cours', 'terminée', 'annulée'] as $statut)
                <option value="{{ $statut }}" {{ old('statut') == $statut ? 'selected' : '' }}>{{ ucfirst($statut) }}</option>
            @endforeach
        </select>
        @error('statut')<div class="error">{{ $message }}</div>@enderror

        <!-- Formateur -->
        <label for="formateur_id">Formateur :</label>
        <select id="formateur_id" name="formateur_id" required>
            <option value="">-- Choisir un formateur --</option>
            @foreach ($formateurs as $formateur)
                <option value="{{ $formateur->id }}" {{ old('formateur_id') == $formateur->id ? 'selected' : '' }}>
                    {{ $formateur->nom }} {{ $formateur->prenom }}
                </option>
            @endforeach
        </select>
        @error('formateur_id')<div class="error">{{ $message }}</div>@enderror

        <!-- Service -->
        <label for="service_id">Service :</label>
        <select id="service_id" name="service_id" required>
            <option value="">-- Choisir un service --</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->nom }}
                </option>
            @endforeach
        </select>
        @error('service_id')<div class="error">{{ $message }}</div>@enderror

        <!-- Participants -->
        <label for="participants">Participants :</label>
        <select id="participants" name="participants[]" multiple>
            @foreach ($participants as $participant)
                <option value="{{ $participant->id }}" {{ collect(old('participants'))->contains($participant->id) ? 'selected' : '' }}>
                    {{ $participant->nom }} {{ $participant->prenom }}
                </option>
            @endforeach
        </select>
        @error('participants')<div class="error">{{ $message }}</div>@enderror
        @error('participants.*')<div class="error">{{ $message }}</div>@enderror

        <button type="submit">Enregistrer</button>
    </form>
@endsection
