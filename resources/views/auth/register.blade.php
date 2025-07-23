@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Créer un compte</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
@endsection
