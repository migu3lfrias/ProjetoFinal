@extends('layouts.fe_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold mb-3">Nova Senha</h5>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        {{-- Usamos request()->email para garantir que o valor vem do URL --}}
                        <input type="email" name="email" class="form-control" value="{{ request()->email ?? $request->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nova Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Alterar Senha</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
