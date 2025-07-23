@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la formation</h2>

    <form action="{{ route('admin.formations.update', $formation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Titre -->
            <div class="col-md-6 mb-3">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" class="form-control"
                    value="{{ old('titre', $formation->titre) }}" required>
                @error('titre') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Description -->
            <div class="col-md-6 mb-3">
                <label for="description">Description :</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $formation->description) }}</textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Type -->
            <div class="col-md-6 mb-3">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control" required>
                    @php
                        $types = ['présentiel', 'en ligne', 'hybride'];
                        $oldType = old('type', $formation->type);
                    @endphp
                    <option value="">-- Choisir un type --</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ $oldType === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Lieu -->
            <div class="col-md-6 mb-3">
                <label for="lieu">Lieu :</label>
                <input type="text" name="lieu" id="lieu" class="form-control"
                    value="{{ old('lieu', $formation->lieu) }}" required>
                @error('lieu') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Date début -->
            <div class="col-md-6 mb-3">
                <label for="date_debut">Date de début :</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control"
                    value="{{ old('date_debut', optional(\Carbon\Carbon::parse($formation->date_debut))->format('Y-m-d')) }}" required>
                @error('date_debut') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Date fin -->
            <div class="col-md-6 mb-3">
                <label for="date_fin">Date de fin :</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control"
                    value="{{ old('date_fin', optional(\Carbon\Carbon::parse($formation->date_fin))->format('Y-m-d')) }}" required>
                @error('date_fin') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Volume horaire -->
            <div class="col-md-6 mb-3">
                <label for="volume_horaire">Volume horaire :</label>
                <input type="number" name="volume_horaire" id="volume_horaire" class="form-control" min="1"
                    value="{{ old('volume_horaire', $formation->volume_horaire) }}" required>
                @error('volume_horaire') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Statut -->
            <div class="col-md-6 mb-3">
                <label for="statut">Statut :</label>
                @php
                    $statuts = ['en_attente' => 'En_attente', 'en_cours' =>'En cours', 'terminee' => 'Terminée', 'annulee' => 'Annulée'];
                    $oldStatut = old('statut', $formation->statut);
                @endphp
                <select name="statut" id="statut" class="form-control" required>
                    <option value="">-- Choisir un statut --</option>
                    @foreach ($statuts as $value => $label)
                        <option value="{{ $value }}" {{ $oldStatut === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('statut') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Direction -->
            <div class="col-md-6 mb-3">
                <label for="direction_id">Direction :</label>
                <select name="direction_id" id="direction_id" class="form-control" required>
                    <option value="">-- Choisir une direction --</option>
                    @foreach($directions as $direction)
                        <option value="{{ $direction->id }}"
                            {{ old('direction_id', $formation->direction_id) == $direction->id ? 'selected' : '' }}>
                            {{ $direction->nom }}
                        </option>
                    @endforeach
                </select>
                @error('direction_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Service -->
            <div class="col-md-6 mb-3">
                <label for="service_id">Service :</label>
                <select name="service_id" id="service_id" class="form-control">
                    <option value="">-- Choisir un service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id', $formation->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->nom }}
                        </option>
                    @endforeach
                    <option value="0" {{ strval(old('service_id', $formation->service_id)) === '0' ? 'selected' : '' }}>Néant</option>
                    <option value="autre" {{ old('service_id') === 'autre' ? 'selected' : '' }}>Autre (saisir manuellement)</option>
                </select>
                @error('service_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Champ manuel si "autre" -->
            <div class="col-md-6 mb-3" id="service_custom_div" style="display: none;">
                <label for="service_custom">Nouveau service :</label>
                <input type="text" name="service_custom" id="service_custom" class="form-control"
                    value="{{ old('service_custom') }}">
                @error('service_custom') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Formateur -->
            <div class="col-md-6 mb-3">
                <label for="formateur_id">Formateur :</label>
                <select name="formateur_id" id="formateur_id" class="form-control" required>
                    <option value="">-- Choisir un formateur --</option>
                    @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}"
                            {{ old('formateur_id', $formation->formateur_id) == $formateur->id ? 'selected' : '' }}>
                            {{ $formateur->nom }} {{ $formateur->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('formateur_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const selectDirection = document.getElementById('direction_id');
    const selectService = document.getElementById('service_id');
    const serviceCustomDiv = document.getElementById('service_custom_div');

    function toggleServiceCustom() {
        if (selectService.value === "autre") {
            serviceCustomDiv.style.display = "block";
        } else {
            serviceCustomDiv.style.display = "none";
            document.getElementById("service_custom").value = "";
        }
    }

    // Charger les services pour la direction sélectionnée
    function loadServices(directionId, selectedServiceId = null) {
        if (!directionId) {
            selectService.innerHTML = '<option value="">-- Choisir un service --</option>';
            selectService.innerHTML += '<option value="0">Néant</option>';
            selectService.innerHTML += '<option value="autre">Autre (saisir manuellement)</option>';
            toggleServiceCustom();
            return;
        }

        fetch(`/directions/${directionId}/services`)
            .then(response => response.json())
            .then(services => {
                let options = '<option value="">-- Choisir un service --</option>';
                services.forEach(service => {
                    options += `<option value="${service.id}"${selectedServiceId == service.id ? ' selected' : ''}>${service.nom}</option>`;
                });
                options += '<option value="0"' + (selectedServiceId == '0' ? ' selected' : '') + '>Néant</option>';
                options += '<option value="autre"' + (selectedServiceId == 'autre' ? ' selected' : '') + '>Autre (saisir manuellement)</option>';
                selectService.innerHTML = options;

                toggleServiceCustom();
            })
            .catch(() => {
                // En cas d'erreur, on vide la liste
                selectService.innerHTML = '<option value="">-- Choisir un service --</option>';
                toggleServiceCustom();
            });
    }

    // Au chargement, charger les services de la direction actuelle et sélectionner le service actuel
    loadServices(selectDirection.value, '{{ old('service_id', $formation->service_id) ?? '' }}');

    // Quand la direction change, recharger la liste des services
    selectDirection.addEventListener('change', () => {
        loadServices(selectDirection.value);
    });

    // Quand le service change, afficher ou non le champ personnalisé
    selectService.addEventListener('change', toggleServiceCustom);
});
</script>
@endpush
