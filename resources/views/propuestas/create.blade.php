@extends('layouts.app')

@section('title', 'Proponer taller')

@push('styles')
<style>

.propuesta-box {
    max-width: 1100px;
    margin: 20px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

.subtitulo-seccion {
    font-weight: 700;
    margin-top: 30px;
    margin-bottom: 15px;
    font-size: 1.2rem;
    color: #0B2B3C;
}

.tallerista-item {
    background: #f7f7f7;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 15px;
}

</style>
@endpush

@section('content')

<div class="propuesta-box">

    <h2 class="titulo-resaltado">
        <span>Propuesta de taller</span>
    </h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">

    <button class="btn btn-outline-dark"
            data-bs-toggle="modal"
            data-bs-target="#modalInfo">

        Información importante sobre la convocatoria

    </button>

</div>

    <form method="POST" action="{{ route('propuestas.store') }}">
        @csrf

        <!-- DATOS GENERALES -->

        <div class="subtitulo-seccion">
            Datos generales
        </div>

        <div class="mb-3">
            <label>Título del taller</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
                <label>
                    Resumen
                    <small class="text-muted">(máx. 150 palabras)</small>
                </label>
                <textarea name="resumen"
                            class="form-control"
                            rows="3"
                            maxlength="1200"
                            required></textarea>
        </div>

        <div class="mb-3">
            <label>
            Descripción (objetivos y dinámica)
            <small class="text-muted">(aprox. 1000 palabras)</small>
        </label>
        <textarea name="descripcion"
                    class="form-control"
                    rows="8"
                    maxlength="8000"
                    required></textarea>

        </div>
        

        <div class="mb-3">
            <label>Jornada</label>

            <select name="jornada" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="17_tarde">TT - Miércoles 17/6 - 14 a 16.30h</option>
                <option value="18_manana">TM - Jueves 18/6 - 9 a 11.30h</option>
                <option value="ambos">Ambos turnos</option>
            </select>
        </div>

        <!-- TALLERISTAS -->

        <div class="subtitulo-seccion">
            Equipo tallerista
        </div>

        <div class="tallerista-item">

            <div class="row">

                <div class="col-md-3">
                    <label>Nombre</label>
                    <input type="text" 
                           name="talleristas[0][nombre]" 
                           class="form-control" 
                           required>
                </div>

                <div class="col-md-3">
                    <label>Apellido</label>
                    <input type="text" 
                           name="talleristas[0][apellido]" 
                           class="form-control" 
                           required>
                </div>

                <div class="col-md-3">
                    <label>Email</label>

                    <input type="email"
                        name="talleristas[0][email]"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-3">
                    <label>Tipo</label>

                    <select name="talleristas[0][tipo]" 
                            class="form-select" 
                            required>

                        <option value="docente">Docente</option>
                        <option value="cursante">Cursante</option>

                    </select>
                </div>

            </div>

        </div>

        <div class="tallerista-item">

            <div class="row">

                <div class="col-md-3">
                    <label>Nombre</label>
                    <input type="text" 
                           name="talleristas[1][nombre]" 
                           class="form-control" 
                           required>
                </div>

                <div class="col-md-3">
                    <label>Apellido</label>
                    <input type="text" 
                           name="talleristas[1][apellido]" 
                           class="form-control" 
                           required>
                </div>

                <div class="col-md-3">
                    <label>Email</label>

                    <input type="email"
                        name="talleristas[1][email]"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-3">
                    <label>Tipo</label>

                    <select name="talleristas[1][tipo]" 
                            class="form-select" 
                            required>

                        <option value="docente">Docente</option>
                        <option value="cursante">Cursante</option>

                    </select>
                </div>

            </div>

        </div>

        <div id="contenedor-talleristas-extra"></div>

            <button type="button"
                    class="btn btn-outline-secondary mb-4"
                    id="btnAgregarTallerista">

                Agregar integrante

            </button>

        <!-- MATERIALES -->

        <div class="subtitulo-seccion">
            Materiales solicitados
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="materiales[]" value="afiches">
            <label class="form-check-label">Afiches</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="materiales[]" value="hojas">
            <label class="form-check-label">Hojas</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="materiales[]" value="marcadores">
            <label class="form-check-label">Marcadores</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="materiales[]" value="lapiceras">
            <label class="form-check-label">Lapiceras</label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="materiales[]" value="postits">
            <label class="form-check-label">Post-it de colores</label>
        </div>

        <!-- COMPUTADORAS -->

        <div class="form-check mb-4">
            <input class="form-check-input" 
                   type="checkbox" 
                   name="solicita_computadoras">

            <label class="form-check-label">
                Computadoras con conexión a Internet
            </label>
        </div>

        <button class="btn btn-dark">
            Enviar propuesta
        </button>

    </form>

</div>

<!-- MODAL INFORMACIÓN -->
<div class="modal fade" id="modalInfo" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Convocatoria a presentar talleres docentes
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <p>
                    <strong>Congreso Secundaria Aprende</strong><br>
                    UdelaCiudad, <i>del 17 y 18 de junio de 2026</i>
                </p>

                @php
    $fechaCierre = \Carbon\Carbon::create(2026, 6, 3);
   $diasRestantes = now()->startOfDay()->diffInDays($fechaCierre, false);
@endphp

<p>
    <strong>Fecha de cierre de la convocatoria:</strong>
    Miércoles 3 de junio de 2026

    @if($diasRestantes > 0)

        <span class="badge rounded-pill bg-success ms-2">
            ¡Quedan {{ $diasRestantes }} días para el cierre!
        </span>

    @elseif($diasRestantes == 0)

        <span class="badge rounded-pill bg-warning text-dark ms-2">
            Último día
        </span>

    @else

        <span class="badge rounded-pill bg-secondary ms-2">
            Convocatoria cerrada
        </span>

    @endif
</p>

                <hr>

                <p>
                    Los talleres se llevarán a cabo en el lapso total de <b>2 horas y media</b>.
                </p>

                <p>
                    Los destinatarios principales del taller son los <b>equipos docentes</b> de las escuelas que se encuentran implementando <b>Secundaria Aprende</b>.
                </p>

                <p>
                    El dictado podrá realizarse durante la <b>tarde de la primera jornada</b>, en la <b>mañana de la segunda jornada</b> o en <b>ambas oportunidades</b>.
                </p>

                <p>
                    Se prevé la asistencia de <b>entre 15 y 25 personas</b> por taller.
                </p>

                <p>
                    La coordinación y dictado del taller tiene que estar a cargo de un <b>grupo mixto de docentes más cursantes</b> del profesorado o <b>sólo cursantes</b>, siempre <b>más de 1 persona</b>.
                </p>

                <p>
                    Cada equipo podrá presentar <b>una o más propuestas</b>.
                </p>

            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>

let contadorTalleristas = 2;

document.getElementById('btnAgregarTallerista')
.addEventListener('click', function () {

    let html = `
    
    <div class="tallerista-item">

        <div class="row">

            <div class="col-md-3">
                <label>Nombre</label>

                <input type="text"
                       name="talleristas[${contadorTalleristas}][nombre]"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-3">
                <label>Apellido</label>

                <input type="text"
                       name="talleristas[${contadorTalleristas}][apellido]"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-3">
                <label>Email</label>

                <input type="email"

                       name="talleristas[${contadorTalleristas}][email]"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-3">

                <label>Tipo</label>

                <select name="talleristas[${contadorTalleristas}][tipo]"
                        class="form-select"
                        required>

                    <option value="docente">Docente</option>
                    <option value="cursante">Cursante</option>

                </select>

            </div>

        </div>

    </div>
    `;

    document
        .getElementById('contenedor-talleristas-extra')
        .insertAdjacentHTML('beforeend', html);

    contadorTalleristas++;

});

</script>
@endpush

@endsection