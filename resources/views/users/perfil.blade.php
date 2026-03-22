@extends('layouts.fe_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4">
                <h4 class="fw-bold mb-4 text-center">O Meu Perfil</h4>

                <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="text-center mb-4">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto de Perfil" class="rounded-circle object-fit-cover shadow-sm" style="width: 120px; height: 120px;">
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center text-white shadow-sm" style="width: 120px; height: 120px; font-size: 3rem;">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nova Foto de Perfil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-bold">Guardar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
