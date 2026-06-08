@extends('layouts.app')

@section('title', 'Asistencia registrada')

@section('content')

<div class="container text-center mt-5">

    @if($yaExistia)

        <h2>✅ Ya habías registrado tu asistencia</h2>

    @else

        <h2>✅ Asistencia registrada correctamente</h2>

    @endif

    <p class="mt-3">
        Fecha del Congreso:
        <strong>{{ $fecha }}</strong>
    </p>

</div>

@endsection