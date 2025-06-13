@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier la formation</h1>

        <form action="{{ route('formations.update', $formation->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Titre --}}
            <div class="mb-3">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre', $formation->titre) }}" class="form-control" required>
                @error('titre')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Type --}}
            <div class="mb-3">
                <label for="type">Type :</label>
                <select id="type" name="type" class="form-control" required>
                    @foreach(['Présentiel', 'En ligne', 'Hybride'] as $type)
                        <option value="{{ $type }}" {{ old('type', $formation->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Dates --}}
            <div class="mb-3">
                <label for="date_debut">Date début :</label>
                <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut', $formation->date_debut->format('Y-m-d')) }}" class="form-control" required>
                @error('date_debut')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="date_fin">Date fin :</label>
                <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin', $formation->date_fin->format('Y-m-d')) }}" class="form-control" required>
                @error('date_fin')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Lieu --}}
            <div class="mb-3">
                <label for="lieu">Lieu :</label>
                <input type="text" id="lieu" name="lieu" value="{{ old('lieu', $formation->lieu) }}" class="form-control" required>
                @error('lieu')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Volume horaire --}}
            <div class="mb-3">
                <label for="volume_horaire">Volume horaire :</label>
                <input type="number" id="volume_horaire" name="volume_horaire" value="{{ old('volume_horaire', $formation->volume_horaire) }}" min="0" class="form-control" required>
                @error('volume_horaire')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Formateur --}}
            <div class="mb-3">
                <label for="formateur_id">Formateur :</label>
                <select id="formateur_id" name="formateur_id" class="form-control" required>
                    <option value="">-- Choisir un formateur --</option>
                    @foreach ($formateurs as $formateur)
                        <option value="{{ $formateur->id }}" {{ old('formateur_id', $formation->formateur_id) == $formateur->id ? 'selected' : '' }}>
                            {{ $formateur->nom }} {{ $formateur->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('formateur_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Service --}}
            <div class="mb-3">
                <label for="service_id">Service :</label>
                <select id="service_id" name="service_id" class="form-control" required>
                    <option value="">-- Choisir un service --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $formation->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->nom }} ({{ $service->direction->nom }})
                        </option>
                    @endforeach
                </select>
                @error('service_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Statut --}}
            <div class="mb-3">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" class="form-control" required>
                    @foreach(['en cours', 'terminée', 'annulée'] as $statut)
                        <option value="{{ $statut }}" {{ old('statut', $formation->statut) == $statut ? 'selected' : '' }}>
                            {{ ucfirst($statut) }}
                        </option>
                    @endforeach
                </select>
                @error('statut')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
