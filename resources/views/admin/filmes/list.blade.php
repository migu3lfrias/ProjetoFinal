@extends('layouts.admin')

@section('title', 'Gerir Filmes')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Gerir Filmes</h2>
        <p class="text-muted mb-0 small">
            {{ method_exists($filmes, 'total') ? $filmes->total() : count($filmes) }} filme(s) encontrado(s)
        </p>
    </div>
    <a href="{{ route('admin.filmes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Novo Filme
    </a>
</div>

{{-- Filtros --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.filmes.list') }}" method="GET" class="row g-2 align-items-center">

            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                            name="search"
                            class="form-control border-start-0 ps-0"
                            placeholder="Pesquisar por nome do filme..."
                            value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-4">
                <select name="genero" class="form-select">
                    <option value="">Todos os Géneros</option>
                    <option value="Ação"    {{ request('genero') == 'Ação'    ? 'selected' : '' }}>Ação</option>
                    <option value="Comédia" {{ request('genero') == 'Comédia' ? 'selected' : '' }}>Comédia</option>
                    <option value="Drama"   {{ request('genero') == 'Drama'   ? 'selected' : '' }}>Drama</option>
                    <option value="Ficção"  {{ request('genero') == 'Ficção'  ? 'selected' : '' }}>Ficção</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                @if(request('search') || request('genero'))
                    <a href="{{ route('admin.filmes.list') }}" class="btn btn-outline-secondary" title="Limpar filtros">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>
</div>

{{-- Tabela --}}
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4" style="width:60px;">#</th>
                    <th style="width:60px;">Capa</th>
                    <th>Título</th>
                    <th>Estúdio</th>
                    <th>Lançamento</th>
                    <th class="text-end pe-4" style="width:180px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($filmes as $filme)
                <tr>
                    <td class="ps-4 small">{{ $filme->id }}</td>
                    <td>
                        <img src="{{ $filme->capa
                                ? (str_starts_with($filme->capa, 'http') ? $filme->capa : asset('storage/' . $filme->capa))
                                : 'https://placehold.co/80x110/1a1e2a/8b92a5?text=?' }}"
                                alt="Capa {{ $filme->titulo }}"
                                class="table-logo"
                                style="width:38px;height:54px;object-fit:cover;"
                                onerror="this.src='https://placehold.co/80x110/1a1e2a/8b92a5?text=?'">
                    </td>
                    <td>
                        <span class="fw-semibold d-block">{{ $filme->titulo }}</span>
                        <span class="badge" style="background:var(--admin-accent-light);color:var(--admin-accent);font-size:0.7rem;">{{ $filme->genero }}</span>
                    </td>
                    <td class="text-muted small">{{ $filme->estudio->name ?? 'N/A' }}</td>
                    <td class="text-muted small">{{ \Carbon\Carbon::parse($filme->data_lancamento)->format('d/m/Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.filmes.edit', $filme->id) }}"
                                class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-xl-inline">Editar</span>
                            </a>
                            <form action="{{ route('admin.filmes.destroy', $filme->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Apagar {{ addslashes($filme->titulo) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                    <i class="bi bi-trash"></i>
                                    <span class="d-none d-xl-inline">Apagar</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-film d-block mb-2 fs-1 opacity-25"></i>
                        <span class="text-muted">Nenhum filme encontrado.</span>
                        @if(request('search') || request('genero'))
                            <a href="{{ route('admin.filmes.list') }}" class="d-block mt-1 small">Limpar filtros</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
