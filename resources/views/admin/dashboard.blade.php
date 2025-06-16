@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="container">
    <h1 class="text-center text-primary my-4">Tableau de bord Administrateur</h1>

    {{-- Liens rapides --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <a href="{{ route('directions.create') }}" class="btn btn-outline-primary w-100 mb-2">➕ Ajouter une Direction</a>
            <a href="{{ route('users.create') }}" class="btn btn-outline-info w-100">➕ Ajouter un Formateur</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('formations.create') }}" class="btn btn-outline-success w-100 mb-2">➕ Ajouter une Formation</a>
            <a href="{{ route('users.create') }}" class="btn btn-outline-secondary w-100">➕ Ajouter un Participant</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('roles.index') }}" class="btn btn-outline-warning w-100">⚙️ Gérer les Rôles</a>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">📈 Formations par Mois</div>
                <div class="card-body">
                    <canvas id="formationsChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">👥 Taux de Participation</div>
                <div class="card-body">
                    <canvas id="participationChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const formationsCtx = document.getElementById('formationsChart').getContext('2d');
    const formationsChart = new Chart(formationsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months ?? ['Jan', 'Feb', 'Mar']) !!},
            datasets: [{
                label: 'Formations',
                data: {!! json_encode($formationsCount ?? [5, 10, 3]) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    const participationCtx = document.getElementById('participationChart').getContext('2d');
    const participationChart = new Chart(participationCtx, {
        type: 'pie',
        data: {
            labels: ['Participants', 'Absents'],
            datasets: [{
                data: {!! json_encode($participationData ?? [75, 25]) !!},
                backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
