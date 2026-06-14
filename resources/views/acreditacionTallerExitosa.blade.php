@extends('layouts.app')

@section('title', 'Asistencia registrada')

@section('content')

<div class="container text-center mt-5">

    @if($yaExiste)

        <h2>
            ✅ Ya habías registrado tu asistencia
        </h2>

    @else

        <h2>
            ✅ Asistencia registrada correctamente
        </h2>

    @endif

</div>

@endsection