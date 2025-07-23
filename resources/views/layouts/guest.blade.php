<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 2.5rem 3rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 360px;
        }
        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.55rem 0.75rem;
            margin-bottom: 1.25rem;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        button {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 0.75rem;
            font-size: 1.1rem;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .footer-text {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.9rem;
            color: #666;
        }
        .footer-text a {
            color: #007BFF;
            text-decoration: none;
            font-weight: 600;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1>Inscription</h1>

        <label for="name">Nom</label>
        <input id="name" type="text" name="name" placeholder="Votre nom complet" required autofocus>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="admin@dgti.local" required>

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" placeholder="••••••••" required>

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" required>

        <button type="submit">S'inscrire</button>

        <p class="footer-text">
            Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
        </p>
    </form>
</body>
</html>
