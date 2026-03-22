@extends('layouts.fe_layout')


@section('content')
<div class="container my-5">

    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">&larr; Voltar</a>
    </div>

    <div class="row align-items-center bg-white p-5 rounded-4 shadow-sm border">

        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="{{ $filme->capa }}"
                onerror="this.onerror=null; this.src='https://placehold.co/400x600/292b2c/FFFFFF?text={{ urlencode($filme->titulo) }}';"
                class="img-fluid rounded-4 shadow"
                alt="Capa de {{ $filme->titulo }}"
                style="max-height: 500px; object-fit: cover;">
        </div>

        <div class="col-md-8 ps-md-5">
            <h1 class="display-4 fw-bold text-dark mb-2">{{ $filme->titulo }}</h1>

            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-primary fs-5 px-3 py-2 me-3">{{ $filme->genero }}</span>
                <span class="text-muted fs-5 fw-semibold"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($filme->data_lancamento)->format('d/m/Y') }}</span>
            </div>

            <hr class="mb-4">

            <h4 class="fw-bold mb-3">Detalhes de Produção</h4>

            <div class="mb-3">
                <h6 class="text-muted text-uppercase fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.85rem;">Estúdio Original</h6>
                <div class="d-flex align-items-center bg-light p-3 rounded-3 d-inline-block">
                    <img src="{{ $filme->estudio->logo }}" alt="Logo {{ $filme->estudio->name }}" style="height: 30px; object-fit: contain;" class="me-3" onerror="this.style.display='none'">
                    <span class="fs-5 fw-bold text-dark">{{ $filme->estudio->name }}</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <h6 class="text-muted text-uppercase fw-bold mb-2" style="letter-spacing: 1px; font-size: 0.85rem;">Sinopse</h6>
                <p class="lead text-secondary">
                    As informações detalhadas e a sinopse completa deste filme serão adicionadas em breve ao nosso catálogo. Fique atento às atualizações do CineCRM!
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
