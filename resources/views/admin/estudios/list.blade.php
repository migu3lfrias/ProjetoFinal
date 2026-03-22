@extends('layouts.admin')

@section('title', 'Gerir Estúdios')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Gerir Estúdios</h2>
        <p class="text-muted mb-0 small">
            {{ method_exists($estudios, 'total') ? $estudios->total() : count($estudios) }} estúdio(s) encontrado(s)
        </p>
    </div>
    <a href="{{ route('admin.estudios.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Novo Estúdio
    </a>
</div>

{{-- Filtros --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ url()->current() }}" method="GET" class="row g-2 align-items-center">

            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Pesquisar estúdio..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-4">
                <select name="ordem" class="form-select">
                    <option value="">Ordenação padrão</option>
                    <option value="az" {{ request('ordem') == 'az' ? 'selected' : '' }}>Alfabética (A → Z)</option>
                    <option value="za" {{ request('ordem') == 'za' ? 'selected' : '' }}>Inversa (Z → A)</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                @if(request('search') || request('ordem'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary" title="Limpar filtros">
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
                    <th style="width:70px;">Logo</th>
                    <th>Nome do Estúdio</th>
                    <th class="text-end pe-4" style="width:180px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($estudios as $estudio)
                <tr>
                    <td class="ps-4 small">{{ $estudio->id }}</td>
                    <td>
                        <img src="{{ $estudio->logo
                                ? (str_starts_with($estudio->logo, 'http') ? $estudio->logo : asset('storage/' . $estudio->logo))
                                : 'https://ui-avatars.com/api/?name=' . urlencode($estudio->name) . '&background=2e3444&color=8b92a5&size=80' }}"
                             alt="Logo {{ $estudio->name }}"
                             class="table-logo"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($estudio->name) }}&background=2e3444&color=8b92a5&size=80'">
                    </td>
                    <td class="fw-semibold">{{ $estudio->name }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.estudios.edit', $estudio->id) }}"
                               class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-xl-inline">Editar</span>
                            </a>
                            <form action="{{ route('admin.estudios.destroy', $estudio->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Apagar {{ addslashes($estudio->name) }}? Os filmes associados podem ficar órfãos.')">
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
                    <td colspan="4" class="text-center py-5">
                        <i class="bi bi-building d-block mb-2 fs-1 opacity-25"></i>
                        <span class="text-muted">Nenhum estúdio encontrado.</span>
                        @if(request('search'))
                            <a href="{{ url()->current() }}" class="d-block mt-1 small">Limpar pesquisa</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($estudios, 'links') && $estudios->lastPage() > 1)
        <div class="card-footer d-flex justify-content-between align-items-center py-3 px-4">
            <span class="text-muted small">
                A mostrar {{ $estudios->firstItem() }}–{{ $estudios->lastItem() }} de {{ $estudios->total() }}
            </span>
            {{ $estudios->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection
