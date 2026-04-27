@extends('layouts.app')

@section('title', 'Consultar inscripción')

@push('styles')
<style>

.consulta-box {
    max-width: 500px;
    margin: 20px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

</style>
@endpush

@section('content')

<div class="consulta-box">

    <h2 class="titulo-resaltado">
        <span>Consultar inscripción</span>
    </h2>

    <p class="mb-3 text-muted">
        Ingresá tu DNI para ver en qué taller estás inscripto.
    </p>

    <form method="POST" action="/consultar-inscripcion">
        @csrf

        <div class="mt-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">

            <a href="{{ route('talleres') ?? '/talleres' }}" class="text-decoration-none">
                Volver a talleres
            </a>

            <button class="btn btn-dark">
                Buscar
            </button>

        </div>

    </form>

</div>

@endsection