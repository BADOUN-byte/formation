@extends('layouts.app')

@section('content')
    <h1>Réinitialiser le mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email">Adresse email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password-confirm">Confirmer le mot de passe</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Réinitialiser</button>@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px; margin: 0 auto; padding-top: 40px;">
    <h2 class="mb-4">Réinitialiser le mot de passe</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Réinitialiser</button>
    </form>
</div>
@endsection

    </form>
@endsection
