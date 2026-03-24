@extends('layouts.fe_layout')

@section('title', 'Filmes')

@section('content')
<div class="container py-4">

    <div class="page-header">
        <h1>Todos os Filmes</h1>
        <a href="{{ route('homepage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Voltar ao Início
        </a>
    </div>

    <div class="filter-bar">
        <form action="{{ url()->current() }}" method="GET" class="row g-2 align-items-center">

            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                            name="search"
                            class="form-control border-start-0 ps-0"
                            placeholder="Pesquisar por nome..."
                            value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-4">
                <select name="genero" class="form-select">
                    <option value="">Todos os Géneros</option>
                    <option value="Ação"     {{ request('genero') == 'Ação'     ? 'selected' : '' }}>Ação</option>
                    <option value="Comédia"  {{ request('genero') == 'Comédia'  ? 'selected' : '' }}>Comédia</option>
                    <option value="Drama"    {{ request('genero') == 'Drama'    ? 'selected' : '' }}>Drama</option>
                    <option value="Ficção"   {{ request('genero') == 'Ficção'   ? 'selected' : '' }}>Ficção</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filtrar
                </button>
                @if(request('search') || request('genero'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary" title="Limpar filtros">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="row g-4">
        @forelse($filmes as $filme)
            <div class="col-6 col-md-3">
                <div class="card film-card h-100">
                    <div class="film-poster-wrap">
                        <img src="{{ $filme->capa }}"
                            onerror="this.onerror=null;this.src='{{ $filme->capa ? asset('storage/' . $filme->capa) : '' }}';this.onerror=function(){this.src='https://placehold.co/400x600/1a1e2e/FFFFFF?text={{ urlencode($filme->titulo) }}';};"
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
                        <div>
                            <h5 class="card-title text-truncate mb-1" title="{{ $filme->titulo }}">
                                {{ $filme->titulo }}
                            </h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-building me-1"></i>
                                {{ $filme->estudio->name ?? 'Estúdio Desconhecido' }}
                            </p>
                        </div>
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
                <p class="mb-0">Nenhum filme encontrado.</p>
                @if(request('search') || request('genero'))
                    <a href="{{ url()->current() }}" class="small mt-1 d-inline-block">Limpar filtros</a>
                @endif
            </div>
        @endforelse
    </div>

</div>
@endsection
