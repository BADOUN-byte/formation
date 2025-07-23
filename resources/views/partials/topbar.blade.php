<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="{{ route('home') }}">DGTI</a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>

    <!-- Search Form -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Rechercher..." aria-label="Search" />
            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <!-- Right Side Navbar -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            @auth
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li><a class="dropdown-item" href="#">Compte</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Se déconnecter</button>
                        </form>
                    </li>
                </ul>
            @else
                <a class="nav-link text-white" href="{{ route('login') }}">Se connecter</a>
                <a class="nav-link text-white" href="{{ route('register') }}">S'inscrire</a>
            @endauth
        </li>
    </ul>
</nav>
