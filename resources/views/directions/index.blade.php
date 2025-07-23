@extends('layouts.app')

@push('styles')
<style>
    .card-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold">📂 Liste des Directions</h1>

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDirectionModal">
            <i class="fas fa-plus-circle me-1"></i> Ajouter une direction
        </button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Cards directions --}}
    <div class="row mb-5">
        @foreach($directions as $direction)
            @php
                $bgMap = [
                    'DGTI' => 'primary',
                    'DSI' => 'success',
                    'DESF' => 'warning',
                    'DASP' => 'info',
                    'DT'   => 'danger',
                    'DIG'  => 'secondary',
                ];
                $iconMap = [
                    'DGTI' => 'fa-building',
                    'DSI' => 'fa-network-wired',
                    'DESF' => 'fa-university',
                    'DASP' => 'fa-briefcase',
                    'DT'   => 'fa-cogs',
                    'DIG'  => 'fa-globe',
                ];
                $name = strtoupper($direction->nom);
                $bgColor = $bgMap[$name] ?? 'dark';
                $icon = $iconMap[$name] ?? 'fa-sitemap';
                $text = in_array($bgColor, ['warning', 'info', 'light']) ? 'text-dark' : 'text-white';
                $formationCount = $direction->formations->count();
            @endphp

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover {{ $text }} bg-{{ $bgColor }} shadow h-100 d-flex flex-column">
                    <div class="card-body text-center">
                        <h2 class="fw-bold text-uppercase">
                            <i class="fas {{ $icon }} me-2"></i> {{ $direction->nom }}
                        </h2>
                        <span class="badge bg-light text-dark mt-2">
                            {{ $formationCount }} formation{{ $formationCount > 1 ? 's' : '' }}
                        </span>
                    </div>

                    <div class="flex-grow-1"></div>

                    <div class="card-footer bg-transparent border-0 d-flex flex-column align-items-center gap-2">
                        <button type="button" 
                                class="btn btn-outline-light w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailsModal" 
                                data-id="{{ $direction->id }}">
                            📋 Voir détails
                        </button>

                        <div class="d-flex justify-content-between w-100 px-2 pt-2">
                            <a href="{{ route('admin.directions.edit', $direction->id) }}" class="{{ $text }}" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.directions.destroy', $direction->id) }}" method="POST" onsubmit="return confirm('Supprimer cette direction ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link {{ $text }} p-0 m-0" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal détails direction -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Détails direction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body" id="modal-body-content">
        Chargement...
      </div>
    </div>
  </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createDirectionModal" tabindex="-1" aria-labelledby="createDirectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle direction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.directions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" required value="{{ old('nom') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var detailsModal = document.getElementById('detailsModal');

        detailsModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var directionId = button.getAttribute('data-id');

            // Afficher message de chargement
            document.getElementById('modal-body-content').innerHTML = 'Chargement...';

            fetch(`/directions/${directionId}/detail`)
                .then(res => {
                    if(!res.ok) throw new Error('Erreur réseau');
                    return res.text();
                })
                .then(html => {
                    document.getElementById('modal-body-content').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('modal-body-content').innerHTML = 'Erreur lors du chargement des détails.';
                });
        });
    });
</script>
@endpush
