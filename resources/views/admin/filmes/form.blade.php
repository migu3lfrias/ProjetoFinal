@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">{{ isset($filme) ? 'Editar Filme' : 'Novo Filme' }}</h2>
    <a href="{{ route('admin.filmes.list') }}" class="btn btn-outline-secondary">&larr; Voltar à Lista</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <form action="{{ isset($filme) ? route('admin.filmes.update', $filme->id) : route('admin.filmes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($filme))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="titulo" class="form-label fw-semibold">Título do Filme <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $filme->titulo ?? '') }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="estudio_id" class="form-label fw-semibold">Estúdio <span class="text-danger">*</span></label>
                    <select class="form-select" id="estudio_id" name="estudio_id" required>
                        <option value="" disabled selected>Escolha um estúdio...</option>
                        @foreach($estudios as $estudio)
                            <option value="{{ $estudio->id }}"
                                {{ old('estudio_id', $filme->estudio_id ?? '') == $estudio->id ? 'selected' : '' }}>
                                {{ $estudio->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="genero" class="form-label fw-semibold">Género <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="genero" name="genero" value="{{ old('genero', $filme->genero ?? '') }}" required placeholder="Ex: Ação, Drama, Comédia">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="data_lancamento" class="form-label fw-semibold">Data de Lançamento <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="data_lancamento" name="data_lancamento" value="{{ old('data_lancamento', isset($filme) ? \Carbon\Carbon::parse($filme->data_lancamento)->format('Y-m-d') : '') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="capa" class="form-label fw-semibold">Carregar Capa do Filme</label>
                <input type="file" class="form-control" id="capa" name="capa" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success px-4 fw-bold">
                <i class="bi bi-save"></i> {{ isset($filme) ? 'Atualizar Filme' : 'Guardar Filme' }}
            </button>
        </form>

    </div>
</div>
@endsection
