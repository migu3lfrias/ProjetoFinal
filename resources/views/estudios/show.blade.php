@extends('layouts.fe_layout')

@section('title', $estudio->name)

@section('content')
<div class="container py-4">

    {{-- Cabeçalho do estúdio --}}
    <div class="studio-detail-header">
        <img src="{{ $estudio->logo ?? '' }}"
             onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($estudio->name) }}&background=e9ecef&color=343a40&size=400&font-size=0.3';"
             class="studio-detail-logo"
             alt="Logo {{ $estudio->name }}">

        <div class="studio-detail-info">
            <h1>{{ $estudio->name }}</h1>
            <p>
                Catálogo de Filmes
                <span class="studio-detail-badge">{{ $estudio->filmes->count() }} registos</span>
            </p>
        </div>

        <div class="ms-auto">
            <a href="{{ route('estudios.list') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar aos Estúdios
            </a>
        </div>
    </div>

    {{-- Grelha de filmes do estúdio --}}
    <div class="row g-4">
        @forelse($estudio->filmes as $filme)
            <div class="col-6 col-md-3">
                <div class="card film-card h-100">
                    <div class="film-poster-wrap">
                        <img src="{{ $filme->capa }}"
                             onerror="this.onerror=null;this.src='https://placehold.co/400x600/292b2c/FFFFFF?text={{ urlencode($filme->titulo) }}';"
                             class="card-img-top"
                             alt="Capa de {{ $filme->titulo }}">
                        <div class="card-img-overlay">
                            <div class="overlay-content">
                                <a href="{{ route('filmes.show', $filme->id) }}" class="btn btn-light btn-sm px-3">
                                    <i class="bi bi-eye me-1"></i> Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title text-truncate mb-3" title="{{ $filme->titulo }}">
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
                <p class="mb-0">Ainda não existem filmes registados para este estúdio.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
