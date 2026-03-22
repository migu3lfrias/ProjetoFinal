@extends('layouts.admin')

@section('title', 'Gerir Utilizadores')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Gerir Utilizadores</h2>
        <p class="text-muted mb-0 small">
            {{ method_exists($users, 'total') ? $users->total() : count($users) }} utilizador(es) encontrado(s)
        </p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Novo Utilizador
    </a>
</div>

{{-- Filtros --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.users.list') }}" method="GET" class="row g-2 align-items-center">

            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Pesquisar por nome ou email..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-4">
                <select name="user_type" class="form-select">
                    <option value="">Todos os Tipos</option>
                    <option value="1" {{ request('user_type') === '1' ? 'selected' : '' }}>Administrador</option>
                    <option value="0" {{ request('user_type') === '0' ? 'selected' : '' }}>Utilizador Normal</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                @if(request('search') || request()->filled('user_type'))
                    <a href="{{ route('admin.users.list') }}" class="btn btn-outline-secondary" title="Limpar filtros">
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
                    <th class="ps-4" style="width:70px;">Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th class="text-end pe-4" style="width:180px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="ps-4">
                        <img src="{{ $user->photo
                                ? asset('storage/' . $user->photo)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2e3444&color=8b92a5&size=80' }}"
                             alt="{{ $user->name }}"
                             class="rounded-circle"
                             style="width:38px;height:38px;object-fit:cover;border:2px solid var(--admin-border);"
                             onerror="this.src='https://ui-avatars.com/api/?name=User&background=2e3444&color=8b92a5&size=80'">
                    </td>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td class="text-muted small">{{ $user->email }}</td>
                    <td>
                        @if($user->user_type == 1)
                            <span class="badge" style="background:var(--admin-accent-light);color:var(--admin-accent);font-size:0.72rem;">
                                <i class="bi bi-shield-check me-1"></i>Admin
                            </span>
                        @else
                            <span class="badge" style="background:var(--admin-surface-2);color:var(--admin-text-muted);font-size:0.72rem;">
                                Utilizador
                            </span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-xl-inline">Editar</span>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Apagar {{ addslashes($user->name) }}?')">
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
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people d-block mb-2 fs-1 opacity-25"></i>
                        <span class="text-muted">Nenhum utilizador encontrado.</span>
                        @if(request('search') || request()->filled('user_type'))
                            <a href="{{ route('admin.users.list') }}" class="d-block mt-1 small">Limpar filtros</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($users, 'links') && $users->lastPage() > 1)
        <div class="card-footer d-flex justify-content-between align-items-center py-3 px-4">
            <span class="text-muted small">
                A mostrar {{ $users->firstItem() }}–{{ $users->lastItem() }} de {{ $users->total() }}
            </span>
            {{ $users->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection
