@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Visão Geral</h2>
        <p class="text-muted mb-0 small">
            Bem-vindo, {{ Auth::user()->name }}. Aqui está o resumo da plataforma.
        </p>
    </div>
    <span class="text-muted small d-none d-md-inline">
        <i class="bi bi-calendar3 me-1"></i>
        {{ now()->translatedFormat('d \d\e F \d\e Y') }}
    </span>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="dash-card">
            <div class="dash-card-icon" style="background:rgba(52,152,219,0.12);color:#3498DB;">
                <i class="bi bi-building"></i>
            </div>
            <div class="dash-card-body">
                <p class="dash-card-label">Estúdios</p>
                <p class="dash-card-value">{{ $totalEstudios }}</p>
            </div>
            <a href="{{ route('admin.estudios.list') }}" class="dash-card-link">
                Gerir <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dash-card">
            <div class="dash-card-icon" style="background:rgba(0,168,150,0.12);color:#00A896;">
                <i class="bi bi-film"></i>
            </div>
            <div class="dash-card-body">
                <p class="dash-card-label">Filmes</p>
                <p class="dash-card-value">{{ $totalFilmes }}</p>
            </div>
            <a href="{{ route('admin.filmes.list') }}" class="dash-card-link">
                Gerir <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dash-card">
            <div class="dash-card-icon" style="background:rgba(255,195,0,0.12);color:#d4a200;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="dash-card-body">
                <p class="dash-card-label">Utilizadores</p>
                <p class="dash-card-value">{{ $totalUsers }}</p>
            </div>
            <a href="{{ route('admin.users.list') }}" class="dash-card-link">
                Gerir <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

</div>

<p class="section-label">Ações Rápidas</p>

<div class="row g-3">

    <div class="col-md-4">
        <a href="{{ route('admin.estudios.create') }}" class="quick-action">
            <div class="quick-action-icon">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <p class="quick-action-title">Novo Estúdio</p>
                <p class="quick-action-sub">Adicionar estúdio ao catálogo</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.filmes.create') }}" class="quick-action">
            <div class="quick-action-icon">
                <i class="bi bi-camera-video-fill"></i>
            </div>
            <div>
                <p class="quick-action-title">Novo Filme</p>
                <p class="quick-action-sub">Registar um novo título</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('homepage') }}" class="quick-action" target="_blank">
            <div class="quick-action-icon">
                <i class="bi bi-box-arrow-up-right"></i>
            </div>
            <div>
                <p class="quick-action-title">Ver Site Público</p>
                <p class="quick-action-sub">Abre numa nova aba</p>
            </div>
        </a>
    </div>

</div>

@endsection
