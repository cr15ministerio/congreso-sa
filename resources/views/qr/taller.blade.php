@extends('layouts.app')

@section('title', 'QR Taller')

@section('content')

<div class="container">

    <div class="card p-5 text-center">

        <h2 class="mb-4">
            Congreso Secundaria Aprende
        </h2>

        <h3 class="mb-3">
            Acreditación de taller
        </h3>

        <h4 class="mb-3">
            {{ $taller->titulo }}
        </h4>

        <p class="mb-1">
            <strong>Fecha:</strong>
            {{ \Carbon\Carbon::parse($taller->dia)->format('d-m-Y') }}
        </p>

        <p class="mb-1">
            <strong>Horario:</strong>
            {{ substr($taller->hora_inicio,0,5) }}
            -
            {{ substr($taller->hora_fin,0,5) }}
        </p>

        @if($taller->aula)
            <p class="mb-4">
                <strong>Aula:</strong>
                {{ $taller->aula }}
            </p>
        @endif

        <img
            src="{{ asset('imgs/qr/taller-'.$taller->id.'.png') }}"
            class="img-fluid mx-auto d-block"
            style="max-width: 400px;">

        <p class="mt-4 fs-5">
            Escaneá este código para registrar tu asistencia al taller.
        </p>

    </div>

</div>

@endsection