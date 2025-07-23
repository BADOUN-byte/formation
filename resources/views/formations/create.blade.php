@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Créer une formation</h1>

    <form action="{{ route('admin.formations.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Titre -->
            <div class="col-md-6 mb-3">
                <label for="titre">Titre :</label>
                <input id="titre" type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
                @error('titre')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Description -->
            <div class="col-md-6 mb-3">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="form-control" required>{{ old('description') }}</textarea>
                @error('description')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Type -->
            <div class="col-md-6 mb-3">
                <label for="type">Type :</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">-- Choisir un type --</option>
                    @foreach(['présentiel', 'distanciel', 'hybride'] as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Date début -->
            <div class="col-md-6 mb-3">
                <label for="date_debut">Date début :</label>
                <input id="date_debut" type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
                @error('date_debut')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Date fin -->
            <div class="col-md-6 mb-3">
                <label for="date_fin">Date fin :</label>
                <input id="date_fin" type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
                @error('date_fin')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Lieu -->
            <div class="col-md-6 mb-3">
                <label for="lieu">Lieu :</label>
                <input id="lieu" type="text" name="lieu" class="form-control" value="{{ old('lieu') }}" required>
                @error('lieu')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Volume horaire -->
            <div class="col-md-6 mb-3">
                <label for="volume_horaire">Volume horaire (heures) :</label>
                <input id="volume_horaire" type="number" name="volume_horaire" class="form-control" value="{{ old('volume_horaire') }}" min="1" required>
                @error('volume_horaire')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Statut -->
            <div class="col-md-6 mb-3">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" class="form-control" required>
                    <option value="">-- Choisir un statut --</option>
                    @foreach(['en_attente', 'en_cours', 'terminee', 'annulee'] as $statut)
                        <option value="{{ $statut }}" {{ old('statut') == $statut ? 'selected' : '' }}>{{ ucfirst($statut) }}</option>
                    @endforeach
                </select>
                @error('statut')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Direction -->
            <div class="col-md-6 mb-3">
                <label for="direction_id">Direction :</label>
                <select id="direction_id" name="direction_id" class="form-control" required>
                    <option value="">-- Choisir une direction --</option>
                    @foreach($directions as $direction)
                        <option value="{{ $direction->id }}" {{ old('direction_id') == $direction->id ? 'selected' : '' }}>
                            {{ $direction->nom }}
                        </option>
                    @endforeach
                </select>
                @error('direction_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Services -->
            <div class="col-md-6 mb-3">
                <label for="services">Services :</label>
                <select id="services" name="services[]" multiple class="form-control">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" data-direction-id="{{ $service->direction_id }}"
                            {{ collect(old('services'))->contains($service->id) ? 'selected' : '' }}>
                            {{ $service->nom }}
                        </option>
                    @endforeach
                </select>
                @error('services')<div class="text-danger">{{ $message }}</div>@enderror
                @error('services.*')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Formateur -->
            <div class="col-md-6 mb-3">
                <label for="formateur_id">Formateur :</label>
                <select id="formateur_id" name="formateur_id" class="form-control" required>
                    <option value="">-- Choisir un formateur --</option>
                    @foreach ($formateurs as $formateur)
                        <option value="{{ $formateur->id }}" {{ old('formateur_id') == $formateur->id ? 'selected' : '' }}>
                            {{ $formateur->nom }} {{ $formateur->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('formateur_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <!-- Participants -->
            <div class="col-md-6 mb-3">
                <label for="participants">Participants :</label>
                <select id="participants" name="participants[]" multiple class="form-control">
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}" {{ collect(old('participants'))->contains($participant->id) ? 'selected' : '' }}>
                            {{ $participant->nom }} {{ $participant->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('participants')<div class="text-danger">{{ $message }}</div>@enderror
                @error('participants.*')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const directionSelect = document.getElementById('direction_id');
        const serviceSelect = document.getElementById('services');

        function filterServices() {
            const selectedDirectionId = directionSelect.value;

            Array.from(serviceSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    option.disabled = false;
                    return;
                }
                if (option.getAttribute('data-direction-id') === selectedDirectionId) {
                    option.hidden = false;
                    option.disabled = false;
                } else {
                    option.hidden = true;
                    option.disabled = true;
                    option.selected = false;
                }
            });
        }

        directionSelect.addEventListener('change', filterServices);
        filterServices();
    });
</script>
@endsection
