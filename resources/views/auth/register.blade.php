@extends('layouts.fe_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-4">
                <h4 class="fw-bold text-center mb-4">Criar Nova Conta</h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirmar Password (o name TEM de ser password_confirmation) --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    {{-- Se tiveres o campo user_type na BD e quiseres definir por defeito como 0 (Público) --}}
                    <input type="hidden" name="user_type" value="0">

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Registar</button>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-decoration-none small text-muted">Já tem conta? Faça login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
