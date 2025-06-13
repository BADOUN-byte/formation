@extends('layouts.app')

@section('content')
<h1>Détails de l'utilisateur</h1>

<ul>
    <li><strong>Nom :</strong> {{ $user->nom }}</li>
    <li><strong>Prénom :</strong> {{ $user->prenom }}</li>
    <li><strong>Email :</strong> {{ $user->email }}</li>
    <li><strong>Matricule :</strong> {{ $user->matricule ?? '-' }}</li>
    <li><strong>Grade :</strong> {{ $user->grade ?? '-' }}</li>
    <li><strong>Fonction :</strong> {{ $user->fonction ?? '-' }}</li>
    <li><strong>Rôle :</strong> {{ $user->role->nom ?? '-' }}</li>
    <li><strong>Service :</strong> {{ $user->service->nom ?? '-' }}</li>
</ul>

<a href="{{ route('users.index') }}">← Retour à la liste</a>
@endsection
