<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DGTI Formation')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- 🌬️ Style du drapeau animé -->
    <style id="drapeau-style">
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('{{ asset('assets/img/imagg.png') }}') no-repeat center center fixed;
            background-size: cover;
            z-index: -10;
            opacity: 0.25;
            animation: wave 30s infinite ease-in-out;
            filter: brightness(1);
            pointer-events: none;
        }

        @keyframes wave {
            0% { background-position: center top; }
            50% { background-position: center bottom; }
            100% { background-position: center top; }
        }
    </style>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 0;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .topbar {
            background-color: #2980b9;
            color: white;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar img.logo {
            height: 40px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            font-size: 0.9rem;
        }
        .menu-center {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .menu-center a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .menu-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('assets/img/image.png') }}" alt="Logo" class="logo">
            <span class="fs-5 fw-bold">
                DIRECTION GENERALE DES TRANSMISSIONS ET DE L'INFORMATIQUE (DGTI)
            </span>
        </div>
        <div class="menu-center d-none d-md-flex">
            <a href="{{ route('home') }}">Accueil</a>
        </div>
        <div>
            @auth
                <a href="#" class="btn btn-outline-light btn-sm" aria-label="Se déconnecter"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm ms-2">S’inscrire</a>
            @endauth
        </div>
    </div>

    <div class="main-wrapper">
        @auth
            <aside class="sidebar">
                <nav>
                    <a href="{{ route('dashboard') }}">🏠 Tableau de bord</a>
                    <a href="{{ route('commentaires.index') }}">💬 Commentaires</a>

                    @if(Auth::user()->isAdmin())
                        <hr>
                        <strong class="d-block px-2 text-muted">👑 Admin</strong>
                        <a href="{{ route('admin.formations.index') }}">📊 Gérer les Formations</a>
                        <a href="{{ route('admin.directions.index') }}">🏢 Gérer les Directions</a>
                        <a href="{{ route('admin.users.index') }}">👥 Gérer les Utilisateurs</a>
                    @endif

                    @if(Auth::user()->isFormateur())
                        <hr>
                        <strong class="d-block px-2 text-muted">📘 Formateur</strong>
                        <a href="{{ route('formateur.formations.index') }}">📘 Mes Formations</a>
                    @endif

                    @if(Auth::user()->isParticipant())
                        <hr>
                        <strong class="d-block px-2 text-muted">🎓 Participant</strong>
                        <div class="px-3">
                            <div class="menu-toggle" onclick="toggleSubMenu(this)" style="cursor: pointer;">
                                <span class="me-1">📚</span> Formations
                                <span class="arrow float-end">&rsaquo;</span>
                            </div>
                            <ul class="submenu list-unstyled ps-4 mt-1" style="display: none;">
                                <li>
                                    <a href="{{ route('participant.formations.index') }}">📝 S’inscrire à une Formation</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </nav>
            </aside>
        @endauth

        <main class="p-4 w-100">
            @if(session('success'))
                <div id="poom-alert"
                     class="alert alert-success alert-dismissible fade show"
                     role="alert"
                     style="
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        z-index: 1050;
                        font-size: 1.2rem;
                        text-align: center;
                        min-width: 300px;
                        opacity: 1;
                     ">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const alert = document.getElementById('poom-alert');
                        if (alert) {
                            alert.style.transform = 'translate(-50%, -50%) scale(1.3)';
                            alert.style.transition = 'transform 0.4s ease';
                            setTimeout(() => {
                                alert.style.transform = 'translate(-50%, -50%) scale(1)';
                            }, 400);

                            let flashes = 0;
                            const interval = setInterval(() => {
                                alert.style.opacity = alert.style.opacity == 0 ? 1 : 0;
                                flashes++;
                                if (flashes > 5) {
                                    clearInterval(interval);
                                    alert.style.opacity = 1;
                                }
                            }, 300);
                        }
                    });
                </script>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <div>
            <img src="{{ asset('assets/img/immm.png') }}" alt="Drapeau Burkina Faso" style="height: 20px; vertical-align: middle;">
            2025 – Version 1.0 – &copy; DGTI
        </div>
    </footer>

    @auth
        @if(Auth::user()->isAdmin())
            <!-- 🌬️ Bouton drapeau animé visible uniquement pour l'admin -->
            <button onclick="toggleDrapeau()" id="toggleDrapeauBtn" 
                class="btn btn-warning btn-sm"
                style="
                    position: fixed;
                    bottom: 12px;
                    right: 12px;
                    z-index: 9999;
                    font-size: 0.6rem;
                    padding: 2px 4px;
                    opacity: 0.6;
                    border-radius: 4px;
                " 
                title="Afficher/Cacher le fond animé du drapeau">
                🌬
            </button>

            <script>
                function toggleDrapeau() {
                    const styleTag = document.getElementById('drapeau-style');
                    if (styleTag) {
                        styleTag.disabled = !styleTag.disabled;
                    }
                }
            </script>
        @endif
    @endauth

    @push('scripts')
    <script>
        function toggleSubMenu(element) {
            const submenu = element.nextElementSibling;
            const arrow = element.querySelector('.arrow');

            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                arrow.innerHTML = '&darr;';
            } else {
                submenu.style.display = 'none';
                arrow.innerHTML = '&rsaquo;';
            }
        }
    </script>
    @endpush

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
