@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Connexion</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       required
                       autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 text-end">
                <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié ?</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
    </div>
</div>
@endsection
