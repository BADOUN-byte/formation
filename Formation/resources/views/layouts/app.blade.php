<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon Site</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts and icons -->
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

<!-- Template CSS -->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Wrapper global -->
    <div id="layoutSidenav" class="d-flex w-100" style="height: 100vh; overflow: hidden;">

        <!-- Sidebar FIXÉ -->
        <div id="layoutSidenav_nav" style="width: 250px; background-color: #343a40; height: 100vh; overflow-y: auto; position: fixed; z-index: 1000;">
            @include('partials.sidebar')
        </div>

        <!-- Contenu principal -->
        <div id="layoutSidenav_content" class="flex-grow-1 d-flex flex-column" style="margin-left: 250px; height: 100vh; overflow-y: auto;">

            <!-- Topbar (optionnellement fixe) -->
            <div style="z-index: 999;">
                @include('partials.topbar')
            </div>

            <!-- Contenu -->
            <main class="flex-grow-1">
                <div class="container-fluid py-4 px-4">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; {{ date('2025') }} DSI/DGTI</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


</body>
</html>