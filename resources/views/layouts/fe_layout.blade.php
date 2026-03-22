<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineCRM — @yield('title', 'Início')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fe_style.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">

            <a class="navbar-brand" href="{{ route('homepage') }}">
                <i class="bi bi-camera-reels me-1"></i> CineCRM
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarPrincipal"
                    aria-controls="navbarPrincipal"
                    aria-expanded="false"
                    aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPrincipal">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('estudios.*') ? 'active' : '' }}" href="{{ route('estudios.list') }}">Estúdios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('filmes.*') ? 'active' : '' }}" href="{{ route('filmes.list') }}">Filmes</a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center gap-2">
                    @if(Route::has('login'))
                        @auth
                            @if(Auth::user()->user_type == 1)
                                <li class="nav-item">
                                    <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-1" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> Painel Admin
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                   href="#"
                                   id="userDropdown"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    @if(Auth::user()->photo)
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                             alt="Foto de {{ Auth::user()->name }}"
                                             class="rounded-circle object-fit-cover"
                                             style="width:28px;height:28px;border:2px solid rgba(0,168,150,0.5);">
                                    @else
                                        <i class="bi bi-person-circle fs-5"></i>
                                    @endif
                                    <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('perfil.show') }}">
                                            <i class="bi bi-person"></i> O meu Perfil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                                <i class="bi bi-box-arrow-right"></i> Sair
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Registar</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    <main>
        @if($errors->any() || session('status') || session('error') || session('sucesso'))
            <div class="container mt-3">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @if(session('status') || session('sucesso'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('status') ?? session('sucesso') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <h5>CineCRM</h5>
                    <p>A sua plataforma para gestão de estúdios e filmes. Descubra, explore e acompanhe o mundo do cinema.</p>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <h5>Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('homepage') }}">Início</a></li>
                        <li><a href="{{ route('estudios.list') }}">Estúdios</a></li>
                        <li><a href="{{ route('filmes.list') }}">Filmes</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <h5>Redes Sociais</h5>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill"></i> Rua Exemplo, 123 — Lisboa</li>
                        <li class="mt-1"><i class="bi bi-envelope-fill"></i> contacto@cinecrm.pt</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                &copy; {{ date('Y') }} CineCRM. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>
