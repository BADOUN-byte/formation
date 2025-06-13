<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Prénom</label>
    <input type="text" name="prenom" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Mot de passe</label>
    <input type="password" name="password" required>

    <label>Matricule</label>
    <input type="text" name="matricule">

    <label>Grade</label>
    <input type="text" name="grade">

    <label>Fonction</label>
    <input type="text" name="fonction">

    <label>Rôle</label>
    <select name="role_id" required>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->nom }}</option>
        @endforeach
    </select>

    <label>Service (optionnel)</label>
    <select name="service_id">
        <option value="">-- Aucun --</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->nom }}</option>
        @endforeach
    </select>

    <button type="submit">Créer</button>
</form>
