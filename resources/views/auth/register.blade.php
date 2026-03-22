@extends('layouts.fe_layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="auth-card">

                <div class="auth-header">
                    <i class="bi bi-camera-reels auth-icon"></i>
                    <h4 class="auth-title">CineCRM</h4>
                    <p class="auth-sub">Cria a tua conta gratuita</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="O teu nome"
                               required
                               autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="o.teu@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Mínimo 8 caracteres"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Password</label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control"
                               placeholder="Repete a password"
                               required>
                    </div>

                    <input type="hidden" name="user_type" value="0">

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-person-plus me-2"></i> Criar Conta
                    </button>

                    <div class="auth-footer-link">
                        Já tem conta?
                        <a href="{{ route('login') }}" class="auth-link">Fazer login</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
