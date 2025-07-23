@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="text-center mb-4">Réinitialiser le mot de passe</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary w-100">Envoyer le lien</button>
        </div>
    </form>
</div>
@endsection
