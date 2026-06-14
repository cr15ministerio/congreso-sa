@extends('layouts.app')

@section('title', 'QR Congreso')

@section('content')

<div class="container">

    <div class="card p-5 text-center">

        <h2 class="mb-4">
            Congreso Secundaria Aprende
        </h2>

        <h3 class="mb-3">
            Acreditación de asistencia
        </h3>

        @if($dia == 1)

            <h4 class="mb-4">
                Jornada 1 - 17 de junio de 2026
            </h4>

            <img
                src="{{ asset('imgs/qr/congreso-dia1.png') }}"
                class="img-fluid mx-auto d-block"
                style="max-width: 400px;">

        @endif

        @if($dia == 2)

            <h4 class="mb-4">
                Jornada 2 - 18 de junio de 2026
            </h4>

            <img
                src="{{ asset('imgs/qr/congreso-dia2.png') }}"
                class="img-fluid mx-auto d-block"
                style="max-width: 400px;">

        @endif

        <p class="mt-4 fs-5">
            Escaneá este código para registrar tu asistencia.
        </p>

    </div>

</div>

@endsection