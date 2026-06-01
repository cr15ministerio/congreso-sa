@extends('layouts.app')

@section('title', 'Mesas')

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
    <span>Mesas</span>
</h1>

@php
$mesasAgrupadas = collect($mesas)->groupBy('fecha');
@endphp

@foreach($mesasAgrupadas as $fecha => $grupo)

<div class="bloque-dia">

   <h2 class="fecha-titulo">
    {{ $fecha }}

    <span>

        @if ($fecha == "miércoles 17/6")

             - 10.30 a 12 h

        @elseif ($fecha == "jueves 18/6")

             - 13 a 15 h

        @endif

    </span>

</h2>

    <div class="row mt-3 g-3">

        @foreach($grupo as $i => $mesa)

       

       <div class="col-12 col-md-6 col-lg-4">

    <div class="card card-taller p-3">

        <h5 class="fw-bold mb-3">
            {{ $mesa['nombre'] }}
        </h5>

        <p class="mb-3">
            {{ $mesa['descripcion'] }}
        </p>

        <hr>

        <p class="mb-1">

            <strong>🕒 Hora:</strong>

            {{ $mesa['hora'] }}

        </p>

        <p class="mb-1">

            <strong>📍 Aula:</strong>

            {{ $mesa['aula'] }}

        </p>

        <p class="mb-0">

            <strong>🏫 Escuela expositora:</strong>

            {{ $mesa['escuela_expositora'] }}

        </p>

    </div>

</div>

        @endforeach

    </div>

</div>

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection