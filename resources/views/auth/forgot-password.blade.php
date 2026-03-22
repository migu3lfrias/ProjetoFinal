@extends('layouts.fe_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold mb-3">Recuperar Senha</h5>
                <p class="text-muted small">Insira o seu email e enviaremos um link para definir uma nova senha.</p>

                @if (session('status'))
                    <div class="alert alert-success small">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email de Recuperação</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar Link de Recuperação</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
