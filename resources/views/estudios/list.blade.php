@extends('layouts.fe_layout')

@section('title', 'Estúdios')

@section('content')
<div class="container py-4">

    {{-- Cabeçalho --}}
    <div class="page-header">
        <h1>Todos os Estúdios</h1>
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
                            placeholder="Pesquisar estúdio..."
                            value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filtrar
                </button>
                @if(request('search') || request('ordem'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary" title="Limpar filtros">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="row g-4">
        @forelse($estudios as $estudio)
            <div class="col-md-6 col-lg-4">
                <div class="card studio-card h-100">
                    <div class="card-img-container">
                        <img src="{{ $estudio->logo }}"
                                onerror="this.onerror=null;this.src='{{ $estudio->logo ? asset('storage/' . $estudio->logo) : '' }}';this.onerror=function(){this.src='https://ui-avatars.com/api/?name={{ urlencode($estudio->name) }}&background=e9ecef&color=343a40&size=400&font-size=0.3';};"
                                class="img-fluid"
                                alt="Logo {{ $estudio->name }}">
                        <div class="overlay">
                            <span class="overlay-count">{{ $estudio->filmes->count() }}</span>
                            <span class="overlay-label">Filmes no Catálogo</span>
                        </div>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title mb-3">{{ $estudio->name }}</h5>
                        <a href="{{ route('estudios.show', $estudio->id) }}" class="btn btn-outline-primary w-100">
                            Ver Catálogo
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-building d-block mb-2 fs-1 opacity-25"></i>
                <p class="mb-0">Nenhum estúdio encontrado.</p>
                @if(request('search') || request('ordem'))
                    <a href="{{ url()->current() }}" class="small mt-1 d-inline-block">Limpar filtros</a>
                @endif
            </div>
        @endforelse
    </div>

</div>
@endsection
