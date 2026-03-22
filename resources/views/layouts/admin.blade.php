<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineCRM') — Administração</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    @yield('styles')
</head>
<body>

    <input type="checkbox" id="sidebar-toggle" hidden>

    <div class="wrapper">

        <nav id="sidebar">
            <div class="sidebar-header">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-camera-reels"></i>
                    CineCRM
                    <span class="badge bg-danger ms-1" style="font-size:0.65rem;">Admin</span>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('admin.estudios.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.estudios.list') }}"><i class="bi bi-building"></i> Gerir Estúdios</a>
                </li>
                <li class="{{ request()->routeIs('admin.filmes.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.filmes.list') }}"><i class="bi bi-film"></i> Gerir Filmes</a>
                </li>
                <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.list') }}"><i class="bi bi-people"></i> Gerir Utilizadores</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="{{ route('homepage') }}" class="download">
                        <i class="bi bi-box-arrow-up-right"></i> Ver Site Público
                    </a>
                </li>
            </ul>
        </nav>

        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid d-flex align-items-center gap-3">

                    <label for="sidebar-toggle" class="sidebar-toggle-label" aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </label>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                id="adminDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if(Auth::check() && Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                            alt="Foto de {{ Auth::user()->name }}"
                                            class="admin-avatar me-1">
                                @else
                                    <i class="bi bi-person-circle fs-5 me-1"></i>
                                @endif
                                <span class="d-none d-md-inline">
                                    {{ Auth::check() ? Auth::user()->name : 'Admin' }}
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('perfil.show') }}">
                                        <i class="bi bi-person"></i> Meu Perfil
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
                    </ul>

                </div>
            </nav>

            @if(session('sucesso'))
                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('sucesso') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if(session('erro'))
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('erro') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="content-body">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>
