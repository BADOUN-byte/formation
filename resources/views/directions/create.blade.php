@extends('layouts.app')

@section('content')
<h1>Créer une nouvelle direction</h1>

<form action="{{ route('admin.directions.store') }}" method="POST">
    @csrf
    <div>
        <label for="nom">Nom de la direction :</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <button type="submit">Créer</button>
</form>
@endsection
