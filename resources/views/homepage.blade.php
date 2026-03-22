@extends('layouts.fe_layout')

@section('title', 'Início')

@section('content')

{{-- ─── Hero ──────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <p class="hero-eyebrow">Bem-vindo ao CineCRM</p>
            <h1 class="hero-title">A Magia de Hollywood<br>num Só Lugar</h1>
            <p class="hero-sub">
                Explore os maiores estúdios de cinema do mundo e descubra os catálogos dos filmes que marcaram gerações.
            </p>
            <div class="hero-actions">
                <a href="{{ route('filmes.list') }}" class="btn btn-primary">
                    <i class="bi bi-play-fill me-1"></i> Explorar Filmes
                </a>
                <a href="{{ route('estudios.list') }}" class="btn btn-outline-light">
                    Ver Estúdios
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ─── Estúdios em Destaque ──────────────────────────────────── --}}
<section class="py-5">
    <div class="container">

        <div class="section-header">
            <div>
                <h2 class="section-title">Estúdios em Destaque</h2>
                <p class="section-subtitle">Os estúdios com maior catálogo na plataforma</p>
            </div>
            <a href="{{ route('estudios.list') }}" class="btn-ver-todos">
                Ver todos <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($estudios as $estudio)
                <div class="col-md-6 col-lg-4">
                    <div class="card studio-card h-100">
                        <div class="card-img-container">
                            <img src="{{ $estudio->logo ?? '' }}"
                                 onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($estudio->name) }}&background=e9ecef&color=343a40&size=400&font-size=0.3';"
                                 class="img-fluid"
                                 alt="Logo {{ $estudio->name }}">
                            <div class="overlay">
                                <span class="overlay-count">{{ $estudio->filmes->count() }}</span>
                                <span class="overlay-label">Filmes no Catálogo</span>
                            </div>
                        </div>
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-bold mb-3">{{ $estudio->name }}</h5>
                            <a href="{{ route('estudios.show', $estudio->id) }}" class="btn btn-outline-primary w-100">
                                Ver Catálogo
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-building d-block mb-2 fs-1 opacity-25"></i>
                    Nenhum estúdio disponível.
                </div>
            @endforelse
        </div>

    </div>
</section>

<div class="container"><hr class="section-hr"></div>

{{-- ─── Filmes em Destaque ─────────────────────────────────────── --}}
<section class="py-5">
    <div class="container">

        <div class="section-header">
            <div>
                <h2 class="section-title">Filmes em Destaque</h2>
                <p class="section-subtitle">Os títulos mais recentes na plataforma</p>
            </div>
            <a href="{{ route('filmes.list') }}" class="btn-ver-todos">
                Ver todos <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($filmes as $filme)
                <div class="col-md-6 col-lg-4">
                    <div class="card film-card h-100">
                        <div class="film-poster-wrap">
                            <img src="{{ $filme->capa ?? '' }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/400x600/1a1e2e/FFFFFF?text={{ urlencode($filme->titulo) }}';"
                                 class="card-img-top"
                                 alt="Capa de {{ $filme->titulo }}">
                            <div class="card-img-overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('filmes.show', $filme->id) }}" class="btn btn-light btn-sm px-4">
                                        <i class="bi bi-eye me-1"></i> Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-bold text-truncate mb-3" title="{{ $filme->titulo }}">
                                {{ $filme->titulo }}
                            </h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="film-badge">{{ $filme->genero }}</span>
                                <small class="text-muted fw-semibold">
                                    {{ \Carbon\Carbon::parse($filme->data_lancamento)->format('Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-film d-block mb-2 fs-1 opacity-25"></i>
                    Nenhum filme disponível.
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection
