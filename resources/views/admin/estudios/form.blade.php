@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">{{ isset($estudio) ? 'Editar Estúdio' : 'Novo Estúdio' }}</h2>
    <a href="{{ route('admin.estudios.list') }}" class="btn btn-outline-secondary">&larr; Voltar à Lista</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <form action="{{ isset($estudio) ? route('admin.estudios.update', $estudio->id) : route('admin.estudios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($estudio))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nome do Estúdio <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $estudio->name ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="logo" class="form-label fw-semibold">Carregar Logótipo</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary px-4 fw-bold">
                <i class="bi bi-save"></i> {{ isset($estudio) ? 'Atualizar Estúdio' : 'Guardar Estúdio' }}
            </button>
        </form>

    </div>
</div>
@endsection
