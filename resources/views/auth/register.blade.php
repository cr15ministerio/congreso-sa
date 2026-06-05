@extends('layouts.app')

@section('title', 'Registro')

@push('styles')
<style>

.registro-box {
    max-width: 850px;
    margin: 20px auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

.opciones-registro {
    display:flex;
    gap:20px;
    margin-top:30px;
    flex-wrap:wrap;
}

.card-opcion {
    flex:1;
    min-width:280px;
    border:2px solid #e5e5e5;
    border-radius:16px;
    padding:25px;
    transition:0.2s;
}

.card-opcion:hover {
    border-color:#8CE1D4;
}

.card-opcion h3 {
    font-size:1.3rem;
    font-weight:700;
    margin-bottom:15px;
}

.card-opcion p {
    color:#666;
}

#formRegistroPersona {
    display:none;
    margin-top:40px;
}

.bloque-extra {
    display:none;
}

.resultadosEscuelas {
    border:1px solid #ccc;
    border-top:none;
    max-height:200px;
    overflow-y:auto;
    background:white;
    position:relative;
    z-index:1000;
}

.resultadoEscuela {
    padding:10px;
    cursor:pointer;
}

.resultadoEscuela:hover {
    background:#f2f2f2;
}

</style>
@endpush

@section('content')

<div class="registro-box">

   @if ($errors->any())

    <div class="alert alert-danger mt-3">

        <ul style="margin-bottom:0;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    <h2 class="titulo-resaltado">
        <span>Registro</span>
    </h2>

    <!-- SELECTOR -->

    <div id="selectorInicial">

        <div class="opciones-registro">

            <div class="card-opcion">

                <h3>Registrarme al congreso</h3>

                <p>
                    Participantes, talleristas,
                    expositores, invitados y
                    equipo organizador.
                </p>

                <button type="button"
                        class="btn btn-dark"
                        id="btnRegistroPersona">

                    Continuar

                </button>

            </div>

            <!-- <div class="card-opcion">

                <h3>Registrar estudiantes</h3>

                <p>
                    Inscripción de estudiantes
                    de Nivel 3, 4 y 5.
                </p>

                <a href="/cargar-estudiantes"
                   class="btn btn-success">

                    Cargar estudiantes

                </a>

            </div> -->

        </div>

    </div>


    <!-- FORMULARIO PERSONAS -->

    <div id="formRegistroPersona">

        <form method="POST"
              action="{{ route('register') }}">

            @csrf

            <div class="row mt-3">

                <div class="col-md-6">
                    <label>Nombre</label>

                    <input type="text"
                           name="nombre"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-6">
                    <label>Apellido</label>

                    <input type="text"
                           name="apellido"
                           class="form-control"
                           required>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">
                    <label>DNI</label>

                    <input type="text"
                           name="DNI"
                           id="dni"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-6">
                    <label>Email</label>

                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control"
                           required>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-12">

                    <label>Rol en el congreso</label>

                    <select name="rol"
                            id="rolCongreso"
                            class="form-control"
                            required>

                        <option value="">
                            Seleccionar...
                        </option>

                        <option value="participante">
                            Participante
                        </option>

                        <option value="tallerista">
                            Tallerista
                        </option>

                        <option value="expositor">
                            Expositor
                        </option>

                        <option value="equipo_organizador">
                            Equipo organizador
                        </option>

                        <option value="invitado">
                            Invitado
                        </option>

                    </select>

                </div>

            </div>

            <!-- TIPO INSTITUCIÓN -->

            <div id="bloqueInstitucion"
                 class="bloque-extra">

                <div class="row mt-3">

                    <div class="col-md-12">

                        <label>Tipo de institución</label>

                        <select name="tipo_institucion"
                                id="tipoInstitucion"
                                class="form-control">

                            <option value="">
                                Seleccionar...
                            </option>

                            <option value="Escuela">
                                Escuela
                            </option>

                            <option value="Universidad">
                                Universidad
                            </option>

                            

                        </select>

                    </div>

                </div>

            </div>

            <!-- UNIVERSIDAD -->

            <div id="bloqueUniversidad"
                 class="bloque-extra">

                <div class="row mt-3">

                    <div class="col-md-12">

                        <label>Universidad</label>

                        <select name="universidad"
                                id="universidad"
                                class="form-control">

                            <option value="">
                                Seleccionar...
                            </option>

                            <option value="Universidad de la Ciudad">
                                Universidad de la Ciudad
                            </option>

                            <option value="Otra universidad">
                                Otra universidad
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            <!-- OTRA UNIVERSIDAD -->

            <div id="bloqueOtraUniversidad"
                 class="bloque-extra">

                <div class="row mt-3">

                    <div class="col-md-12">

                        <label>Nombre universidad</label>

                        <input type="text"
                               name="organizacion"
                               class="form-control">

                    </div>

                </div>

            </div>

            <!-- ESCUELA -->

            <div id="bloqueEscuela"
                 class="bloque-extra">

                <div class="row mt-3">

                    <div class="col-md-6">

                        <label>Área</label>

                        <select name="area"
                                id="area"
                                class="form-control">

                            <option value="">
                                Seleccionar...
                            </option>

                            <option value="DEM">DEM</option>
                            <option value="DEA">DEA</option>
                            <option value="DENS">DENS</option>
                            <option value="DET">DET</option>
                            <option value="PRIV">DGEGP</option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label>Escuela</label>

                        <input type="text"
                               id="busquedaEscuela"
                               name="escuela"
                               class="form-control"
                               autocomplete="off"
                               placeholder="Escriba palabras clave...">

                        <div id="resultadosEscuelas"
                             class="resultadosEscuelas">
                        </div>

                    </div>

                </div>

            </div>

            <!-- INVITADO -->

            <div id="bloqueInvitado"
                 class="bloque-extra">

                <div class="row mt-3">

                    <div class="col-md-12">

                        <label>Organización</label>

                        <input type="text"
                               name="organizacion_invitado"
                               class="form-control">

                    </div>

                </div>

            </div>

              <!-- agregado para rol_en_la_escuela -->
                     <div class="row mt-3">
                        <div class="col-md-12">

                            <label>
                                Rol en su institución / escuela
                            </label>

                            <input type="text"
                                name="rol_en_escuela"
                                class="form-control"
                                placeholder="Ej: docente, coordinador TIC, supervisor, bibliotecario...">

                        </div>
                    </div>
                    <!-- fin de agregado -->

            <!-- MINISTERIO -->

            <div id="bloqueMinisterio"
                 class="bloque-extra">

                <div class="alert alert-info mt-3">

                    Organización asignada:
                    <strong>
                        Ministerio de Educación GCBA
                    </strong>

                </div>

            </div>

            <!-- PASSWORD -->

            <div class="row mt-4">

                <div class="col-md-6">

                    <label>Contraseña</label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label>Confirmar contraseña</label>

                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>

                </div>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">

                <a href="{{ route('login') }}"
                   class="text-decoration-none">

                    ¿Ya estás registrado?

                </a>

                <button class="btn btn-dark">
                    Registrarse
                </button>

            </div>

        </form>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // MOSTRAR FORM

    document.getElementById('btnRegistroPersona')
        .addEventListener('click', function () {

            document.getElementById('selectorInicial')
                .style.display = 'none';

            document.getElementById('formRegistroPersona')
                .style.display = 'block';

        });

        // nostrar mensaje de error
        @if ($errors->any())

    document.getElementById('selectorInicial')
        .style.display = 'none';

    document.getElementById('formRegistroPersona')
        .style.display = 'block';

@endif
        // fin de mensaje de error

    // LIMPIAR DNI

    document.getElementById('dni')
        .addEventListener('input', function () {

            this.value = this.value.replace(/\D/g, '');

        });

    // BLOQUES

    const rol = document.getElementById('rolCongreso');

    const bloqueInstitucion =
        document.getElementById('bloqueInstitucion');

    const bloqueUniversidad =
        document.getElementById('bloqueUniversidad');

    const bloqueOtraUniversidad =
        document.getElementById('bloqueOtraUniversidad');

    const bloqueEscuela =
        document.getElementById('bloqueEscuela');

    const bloqueInvitado =
        document.getElementById('bloqueInvitado');

    const bloqueMinisterio =
        document.getElementById('bloqueMinisterio');

    rol.addEventListener('change', function () {

        ocultarTodos();

        if (
            this.value === 'participante' ||
            this.value === 'tallerista' ||
            this.value === 'expositor'
        ) {

            bloqueInstitucion.style.display = 'block';

        }

        if (this.value === 'invitado') {

            bloqueInvitado.style.display = 'block';

        }

        if (this.value === 'equipo_organizador') {

            bloqueMinisterio.style.display = 'block';

        }

    });

    document.getElementById('tipoInstitucion')
        .addEventListener('change', function () {

            bloqueUniversidad.style.display = 'none';
            bloqueOtraUniversidad.style.display = 'none';
            bloqueEscuela.style.display = 'none';

            if (this.value === 'Universidad') {

                bloqueUniversidad.style.display = 'block';

            }

            if (this.value === 'Escuela') {

                bloqueEscuela.style.display = 'block';

            }

        });

    document.getElementById('universidad')
        .addEventListener('change', function () {

            bloqueOtraUniversidad.style.display = 'none';

            if (this.value === 'Otra universidad') {

                bloqueOtraUniversidad.style.display = 'block';

            }

        });

    function ocultarTodos() {

        bloqueInstitucion.style.display = 'none';
        bloqueUniversidad.style.display = 'none';
        bloqueOtraUniversidad.style.display = 'none';
        bloqueEscuela.style.display = 'none';
        bloqueInvitado.style.display = 'none';
        bloqueMinisterio.style.display = 'none';

    }

    // BUSCAR ESCUELAS

    const inputEscuela =
        document.getElementById('busquedaEscuela');

    const resultados =
        document.getElementById('resultadosEscuelas');

    inputEscuela.addEventListener('keyup', async function () {

        const area =
            document.getElementById('area').value;

        const q = this.value;

        if (q.length < 2 || area === '') {

            resultados.innerHTML = '';
            return;

        }

        const response =
            await fetch(`/buscar-escuelas?area=${area}&q=${q}`);

        const escuelas =
            await response.json();

        resultados.innerHTML = '';

        escuelas.forEach(function (escuela) {

            const div =
                document.createElement('div');

            div.classList.add('resultadoEscuela');

            div.innerText = escuela;

            div.addEventListener('click', function () {

                inputEscuela.value = escuela;
                resultados.innerHTML = '';

            });

            resultados.appendChild(div);

        });

    });

});

</script>

@endsection