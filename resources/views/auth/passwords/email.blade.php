@extends('layouts.app')

@section('content')
    <h1>Mot de passe oublié</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">Adresse email</label>
            <input id="email" type="email" name="email" required>
        </div>

        <button type="submit">Envoyer le lien de réinitialisation</button>
    </form>
@endsection
