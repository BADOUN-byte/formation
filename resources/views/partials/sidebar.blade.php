<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">DGTI</div>

                <!-- Dashboard -->
                <a class="nav-link collapsed text-warning sidebar-hover" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- Gestion des directions -->
                <a class="nav-link text-primary sidebar-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDirections" aria-expanded="false" aria-controls="collapseDirections">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    Gestion des directions
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDirections" aria-labelledby="headingDirections" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('directions.index') }}">Liste des directions</a>
                        {{-- <a class="nav-link" href="{{ route('directions.create') }}">Ajouter une direction</a> --}}
                    </nav>
                </div>

                <!-- Statistiques Générales -->
                <a class="nav-link collapsed text-success sidebar-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Statistiques Générales
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <!-- Authentication sous-menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                @guest
                                    <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                                    <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
                                    <a class="nav-link" href="{{ route('password.request') }}">Mot de passe oublié</a>
                                @else
                                    <a class="nav-link disabled">Bonjour, {{ Auth::user()->name }}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link text-start">Déconnexion</button>
                                    </form>
                                @endguest
                            </nav>
                        </div>

                        <!-- Statistiques détaillées -->
                        <a class="nav-link collapsed text-warning sidebar-hover" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseStats" aria-expanded="false" aria-controls="pagesCollapseStats">
                            Statistiques des votes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseStats" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">Statistiques Journalier</a>
                                <a class="nav-link" href="#">Statistiques par Semaine</a>
                                <a class="nav-link" href="#">Statistiques dans le mois</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Addons</div>

                <!-- Charts -->
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>

                <!-- Tables -->
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>

        <!-- Footer dynamique -->
        <div class="sb-sidenav-footer">
            <div class="small">
                @auth
                    Connecté en tant que {{ Auth::user()->name }}
                @else
                    Non connecté
                @endauth
            </div>
        </div>
    </nav>
</div>
