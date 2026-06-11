@extends('layouts.app')

@section('title', 'Propuestas de talleres')

@push('styles')
<style>

.propuestas-box {
    max-width: 1200px;
    margin: 20px auto;
}

.card-propuesta {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    overflow: hidden;
}

.card-header-propuesta {
    background: #8CE1D4;
    padding: 15px 20px;
}

.card-header-propuesta h5 {
    margin: 0;
    font-weight: 700;
}

.estado-badge {
    font-size: 0.85rem;
}

.meta {
    font-size: 0.9rem;
    color: #555;
}

.tallerista-pill {
    background: #f1f1f1;
    border-radius: 20px;
    padding: 5px 12px;
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 5px;
    font-size: 0.85rem;
}

</style>
@endpush

@section('content')

<div class="propuestas-box">

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="titulo-resaltado mb-0">
        <span>Propuestas recibidas</span>
    </h2>

    <div>

        <button class="btn btn-dark btn-sm"
                id="btnModoFichas">

            Fichas

        </button>

        <button class="btn btn-outline-dark btn-sm"
                id="btnModoGrilla">

            Grilla

        </button>

    </div>

</div>

<div id="modoFichas">

    @if($propuestas->count() == 0)

        <div class="alert alert-warning">
            No hay propuestas cargadas.
        </div>

    @else

        @foreach($propuestas as $p)

            <div class="card card-propuesta">

                <div class="card-header-propuesta d-flex justify-content-between align-items-center">

                    <h5>
                        {{ $p->titulo }}
                    </h5>

                    <span class="badge bg-secondary estado-badge">
                        {{ ucfirst($p->estado) }}
                    </span>

                </div>

                <div class="card-body">

                    <div class="meta mb-2">
                        <strong>Jornada:</strong>

                        @if($p->jornada == '17_tarde')
                            17 a la tarde
                        @elseif($p->jornada == '18_manana')
                            18 a la mañana
                        @else
                            Ambos turnos
                        @endif
                    </div>

                    <div class="meta mb-3">
                        <strong>Enviada:</strong>
                        {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}
                    </div>

                    <p>
                        {{ $p->resumen }}
                    </p>

                    <div class="mb-3">

                        <strong>Talleristas:</strong><br>

                        @foreach($p->talleristas as $t)

                            <span class="tallerista-pill">
                                {{ $t->nombre }} {{ $t->apellido }}
                                ({{ $t->tipo }})
                            </span>

                        @endforeach

                    </div>

                    <button class="btn btn-outline-dark btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalPropuesta{{ $p->id }}">

                        Ver propuesta completa

                    </button>

                </div>

            </div>

        @endforeach

    @endif
</div>

            <!-- modo grilla -->
            <div id="modoGrilla" style="display:none;">

                <div class="table-responsive">

                   <table id="tablaPropuestas"
       class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th style="width: 100px;">
    Estado
</th>

                                <th>Jornada</th>

                                <th>Título</th>

                                <th>Talleristas</th>

                                <th>Computadoras</th>

                                <th>Materiales</th>

                                <th>Fecha</th>

                                <th>Ver/Editar</th>

                                <th>Crear taller</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($propuestas as $p)

                                <tr>

                                    <td>

<form method="POST"
      action="{{ route('propuestas.estado', $p) }}">

    @csrf

    <select name="estado"
            class="form-select form-select-sm"
            onchange="this.form.submit()">

        <option value="pendiente"
            {{ $p->estado == 'pendiente' ? 'selected' : '' }}>
            🕒 Pendiente
        </option>

        <option value="aceptada"
            {{ $p->estado == 'aceptada' ? 'selected' : '' }}>
            ✅ Aceptada
        </option>

        <option value="rechazada"
            {{ $p->estado == 'rechazada' ? 'selected' : '' }}>
            ❌ Rechazada
        </option>

    </select>

</form>

</td>

                                    <td>

                                        @if($p->jornada == '17_tarde')
                                            17 tarde

                                        @elseif($p->jornada == '18_manana')
                                            18 mañana

                                        @else
                                            Ambos

                                        @endif

                                    </td>

                                    <td>
                                        {{ $p->titulo }}
                                    </td>

                                    <td>

                                        @foreach($p->talleristas as $t)

                                            <div>
                                                {{ $t->apellido }},
                                                {{ $t->nombre }}
                                            </div>

                                        @endforeach

                                    </td>

                                    <td>

                                        {{ $p->solicita_computadoras ? 'Sí' : 'No' }}

                                    </td>

                                    <td>

                                        {{ $p->materiales }}

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}

                                    </td>

                                    <td>

    <div class="d-flex gap-1">

        <button class="btn btn-outline-dark btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalPropuesta{{ $p->id }}">

            Ver

        </button>

        <a href="{{ route('propuestas.edit', $p) }}"
           class="btn btn-primary btn-sm">

            Editar

        </a>

    </div>

</td>
<td>

@if(
    auth()->user()->email == 'cristian.rizzi@bue.edu.ar'
    && $p->estado == 'aceptada'
)

    <form method="POST"
          action="{{ route('propuestas.crearTaller', $p) }}">

        @csrf

        <button class="btn btn-success btn-sm">
            ➕ Crear
        </button>

    </form>

@endif

</td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
            <!-- fin modo grilla -->

            @foreach($propuestas as $p)
            <!-- MODAL -->
            <div class="modal fade"
                 id="modalPropuesta{{ $p->id }}"
                 tabindex="-1">

                <div class="modal-dialog modal-xl modal-dialog-scrollable">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">
                                {{ $p->titulo }}
                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                            </button>

                        </div>

                        <div class="modal-body">

                            <h6>Resumen</h6>

                            <p>
                                {{ $p->resumen }}
                            </p>

                            <hr>

                            <h6>Descripción</h6>

                            <p style="white-space: pre-line;">
                                {{ $p->descripcion }}
                            </p>

                            <hr>

                            <h6>Talleristas</h6>

                            <ul>

                                @foreach($p->talleristas as $t)

                                    <li>
                                        {{ $t->apellido }},
                                        {{ $t->nombre }}
                                        —
                                        {{ $t->tipo }}
                                        —
                                        {{ $t->email }}
                                    </li>

                                @endforeach

                            </ul>

                            <hr>

                            <h6>Materiales solicitados</h6>

                            <p>
                                {{ $p->materiales ?: 'No especificados' }}
                            </p>

                            <hr>

                            <h6>Computadoras</h6>

                            <p>
                                {{ $p->solicita_computadoras ? 'Sí' : 'No' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>
            <!-- fin del modal -->
             @endforeach

</div>

@push('scripts')
<script>

const btnModoFichas = document.getElementById('btnModoFichas');
const btnModoGrilla = document.getElementById('btnModoGrilla');

const modoFichas = document.getElementById('modoFichas');
const modoGrilla = document.getElementById('modoGrilla');

btnModoFichas.addEventListener('click', function () {

    modoFichas.style.display = 'block';
    modoGrilla.style.display = 'none';

    btnModoFichas.classList.remove('btn-outline-dark');
    btnModoFichas.classList.add('btn-dark');

    btnModoGrilla.classList.remove('btn-dark');
    btnModoGrilla.classList.add('btn-outline-dark');

});

btnModoGrilla.addEventListener('click', function () {

    modoFichas.style.display = 'none';
    modoGrilla.style.display = 'block';

    btnModoGrilla.classList.remove('btn-outline-dark');
    btnModoGrilla.classList.add('btn-dark');

    btnModoFichas.classList.remove('btn-dark');
    btnModoFichas.classList.add('btn-outline-dark');

});

$(document).ready(function () {

    $('#tablaPropuestas').DataTable({

        pageLength: 25,

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
        }

    });

});

</script>
@endpush

@endsection