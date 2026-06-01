@extends('layouts.app')

@section('title', 'Stands')

@push('styles')
<style>

body {
    background-color: #f7f7f7;
}

.bloque-dia {
    margin-top: 40px;
}

.card-taller {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.1s ease;
    height: 100%;
}

.card-taller:hover {
    transform: translateY(-3px);
}

.tag-dia {
    display: inline-block;
    background: #ffe066;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
}

.fecha-titulo {
    font-weight: 800;
    font-size: 1.6rem;
    border-left: 6px solid #00bcd4;
    padding-left: 10px;
    margin-top: 30px;
}

.titulo-resaltado span {
    position: relative;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    color: #0B2B3C;
    display: inline-block;
}

.titulo-resaltado span::before {
    content: "";
    position: absolute;
    left: -6px;
    right: -6px;
    bottom: 0.45em;
    height: 0.45em;
    background: #FFD000;
    z-index: -2;
}

.titulo-resaltado span::after {
    content: "";
    position: absolute;
    left: -2px;
    right: -2px;
    bottom: 0.15em;
    height: 0.45em;
    background: #8CE1D4;
    z-index: -1;
}

</style>
@endpush

@section('content')

<h1 class="titulo-resaltado">
    <span>Stands</span>
</h1>

@php
$standsAgrupados = collect($stands)->groupBy('fecha');
@endphp

@foreach($standsAgrupados as $fecha => $grupo)

<div class="bloque-dia">

    <h2 class="fecha-titulo">
        {{ $fecha }}
    </h2>

    <div class="row mt-3 g-3">

        @foreach($grupo as $i => $stand)

        <div class="modal fade"
             id="modalMesa{{ $loop->parent->index }}_{{ $loop->index }}"
             tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            {{ $stand['nombre'] }}
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <p>
                            {{ $stand['descripcion'] }}
                        </p>

                        <hr>

                        <p>
                            <strong>Hora:</strong>
                            {{ $stand['hora'] }}
                        </p>

                        <p>
                            <strong>Aula:</strong>
                            {{ $stand['aula'] }}
                        </p>

                        <p>
                            <strong>Escuela expositora:</strong>
                            {{ $stand['escuela_expositora'] }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-6 col-md-4 col-lg-3">

            <div class="card card-taller p-3">

                <h6 class="fw-bold">
                    {{ $stand['nombre'] }}
                </h6>

                <p class="small text-muted">

                    <b>Hora:</b>
                    {{ $stand['hora'] }}

                </p>

                <p class="small text-muted">

                    <b>Lugar:</b>
                    {{ $stand['aula'] }}

                </p>

                <button class="btn btn-outline-dark btn-sm w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#modalMesa{{ $loop->parent->index }}_{{ $loop->index }}">

                    Ver más

                </button>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection