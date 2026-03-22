@extends('layouts.fe_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/user.png') }}" width="70" onerror="this.src='https://ui-avatars.com/api/?name=Cine&background=0D6EFD&color=fff'">
                        <h4 class="fw-bold mt-2">Login CineCRM</h4>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                            @error('email') <span class="invalid-feedback">Credenciais inválidas.</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <a href="{{ route('password.request') }}" class="small text-decoration-none">Esqueceu-se da senha?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
