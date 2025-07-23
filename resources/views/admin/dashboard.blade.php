{{-- GESTION DES ÉLÉMENTS (Admin) --}}
@if(Auth::user()->isAdmin())
<div class="container mt-5">
    <div class="row">
        {{-- Directions --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-sitemap"></i> Directions</span>
                    <a href="{{ route('directions.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($directions as $direction)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $direction->nom }}
                                <span>
                                    <a href="{{ route('directions.edit', $direction->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('directions.destroy', $direction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette direction ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Services --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-building"></i> Services</span>
                    <a href="{{ route('services.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($services as $service)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $service->nom }}
                                <span>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce service ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Formations --}}
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-book"></i> Formations</span>
                    <a href="{{ route('formations.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($formations as $formation)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $formation->titre }}
                                <span>
                                    <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette formation ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Formateurs --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-chalkboard-teacher"></i> Formateurs
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($formateurs as $formateur)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $formateur->name }}
                                <a href="{{ route('users.edit', $formateur->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Participants --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-user-graduate"></i> Participants
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($participants as $participant)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $participant->name }}
                                <a href="{{ route('users.edit', $participant->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
