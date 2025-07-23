@extends('layouts.app') {{-- Si tu as un layout commun --}}
@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
    <h1 class="text-2xl font-bold mb-4">Modifier mon profil</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" class="w-full border rounded px-3 py-2" required>
            @error('nom')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" class="w-full border rounded px-3 py-2" required>
            @error('prenom')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2" required>
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="btn bg-gray-300 text-gray-800 mr-2">Annuler</a>
            <button type="submit" class="btn">Enregistrer</button>
        </div>
    </form>
</div>

<style>
    .btn {
        display: inline-block;
        background: #1d4ed8;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
    }
    .btn:hover {
        background: #2563eb;
    }
</style>
@endsection
