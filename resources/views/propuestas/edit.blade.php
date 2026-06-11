@extends('layouts.app')

@section('title', 'Editar propuesta')

@section('content')

<div class="container" style="max-width:900px;">

    <h2 class="titulo-resaltado mb-4">
        <span>Editar propuesta</span>
    </h2>

    <form method="POST"
          action="{{ route('propuestas.update', $propuesta) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="form-label">
                Título
            </label>

            <input type="text"
                   name="titulo"
                   class="form-control"
                   value="{{ old('titulo', $propuesta->titulo) }}"
                   required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Resumen
            </label>

            <textarea name="resumen"
                      rows="4"
                      class="form-control"
                      required>{{ old('resumen', $propuesta->resumen) }}</textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Descripción
            </label>

            <textarea name="descripcion"
                      rows="8"
                      class="form-control"
                      required>{{ old('descripcion', $propuesta->descripcion) }}</textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Jornada
            </label>

            <select name="jornada"
                    class="form-select">

                <option value="17_tarde"
                    {{ $propuesta->jornada == '17_tarde' ? 'selected' : '' }}>
                    17 a la tarde
                </option>

                <option value="18_manana"
                    {{ $propuesta->jornada == '18_manana' ? 'selected' : '' }}>
                    18 a la mañana
                </option>

                <option value="ambos"
                    {{ $propuesta->jornada == 'ambos' ? 'selected' : '' }}>
                    Ambos turnos
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Estado
            </label>

            <select name="estado"
                    class="form-select">

                <option value="pendiente"
                    {{ $propuesta->estado == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="aceptada"
                    {{ $propuesta->estado == 'aceptada' ? 'selected' : '' }}>
                    Aceptada
                </option>

                <option value="rechazada"
                    {{ $propuesta->estado == 'rechazada' ? 'selected' : '' }}>
                    Rechazada
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Materiales
            </label>

            <textarea name="materiales"
                      rows="3"
                      class="form-control">{{ old('materiales', $propuesta->materiales) }}</textarea>

        </div>

        <div class="form-check mb-4">

            <input type="checkbox"
                   name="solicita_computadoras"
                   class="form-check-input"
                   id="computadoras"
                   {{ $propuesta->solicita_computadoras ? 'checked' : '' }}>

            <label class="form-check-label"
                   for="computadoras">

                Solicita computadoras

            </label>

        </div>

        <button class="btn btn-primary">
            Guardar cambios
        </button>

        <a href="{{ route('propuestas.index') }}"
           class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>

@endsection