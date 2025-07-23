<h2>Mes Formations</h2>
@foreach($formations as $formation)
    <div style="background-color: #eee; padding: 10px; margin-bottom: 10px;">
        <strong>{{ $formation->titre }}</strong><br>
        <em>{{ $formation->description }}</em><br>
        <a href="{{ route('admin.formations.show', $formation) }}">📂 Détails</a>
    </div>
@endforeach
