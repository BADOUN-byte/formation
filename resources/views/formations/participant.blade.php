<h2>Choisissez une Formation</h2>
@foreach($formations as $formation)
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <strong>{{ $formation->titre }}</strong><br>
        <em>{{ $formation->description }}</em><br>
        <form action="{{ route('participant.formations.inscrire', $formation) }}" method="POST">
            @csrf
            <button type="submit">S'inscrire</button>
            @if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if (session('info'))
    <div style="color: orange;">{{ session('info') }}</div>
@endif

@if (session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

        </form>
    </div>
@endforeach
