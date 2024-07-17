<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
   
    <style>
        .navbar, .footer {
            background-color: rgba(255, 255, 255, 0.5); /* Blanco con opacidad */
            color: black; /* Texto negro */
        }
        .navbar a, .footer a {
            color: black; /* Asegura que los enlaces sean negros */
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container px-5">
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 small fw-bolder ms-3">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/conocenos') }}">Conócenos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/proximamente') }}">Próximamente</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.form') }}">Iniciar Sesion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.form') }}">Registrate</a>
                            </li>
                        @else
                            <li class="nav-item me-3 d-flex align-items-center">
                                <a class="nav-link" href="{{ route('profile.index') }}">
                                    @if(Auth::user()->photo)
                                        <img src="{{ asset('uploads/photos/' . Auth::user()->photo) }}" alt="Profile Photo" style="width: 35px; height: 35px; border-radius: 50%; margin-right: 8px;">
                                    @endif
                                    {{ Auth::user()->profile->firstname ?? 'Perfil' }} {{ Auth::user()->profile->firstlastname ?? '' }}
                                </a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" href="{{ route('travels.index') }}">Viajes</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Cerrar Sesion</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="py-4">
            @yield('content')
        </div>
    </main>
    <footer class="footer bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto"><div class="small m-0">Copyright &copy; Zig Zapp 2024</div></div>
                <div class="col-auto">
                    <span class="mx-1">&middot;</span>
                    <a class="small" href="terminos.html">Terminos</a>
                    <span class="mx-1">&middot;</span>
                    <a class="small" href="terminos.html">Contactanos</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('front/js/scripts.js') }}"></script>
</body>
</html>