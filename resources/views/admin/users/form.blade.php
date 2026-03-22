@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0 p-4">
    <h2 class="fw-bold mb-4">{{ isset($user) ? 'Editar Utilizador' : 'Novo Utilizador' }}</h2>

    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password {{ isset($user) ? '(Deixe vazio para não alterar)' : '' }}</label>
            <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>

        <div class="mb-4">
            <label class="form-label">Foto de Perfil</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Utilizador</button>
    </form>
</div>
@endsection
