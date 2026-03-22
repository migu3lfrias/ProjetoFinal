@extends('layouts.fe_layout')

@section('title', 'Entrar')

@section('main-class', 'auth-main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="auth-card">

                <div class="auth-header">
                    <i class="bi bi-camera-reels auth-icon"></i>
                    <h4 class="auth-title">CineCRM</h4>
                    <p class="auth-sub">Inicia sessão para continuar</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="o.teu@email.com"
                                required
                                autofocus>
                        @error('email')
                            <div class="invalid-feedback">Credenciais inválidas.</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="••••••••"
                                required>
                    </div>

                    <div class="mb-4 text-end">
                        <a href="{{ route('password.request') }}" class="auth-link-small">
                            Esqueceu-se da password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
                    </button>

                    <div class="auth-footer-link">
                        Não tem conta?
                        <a href="{{ route('register') }}" class="auth-link">Registar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
