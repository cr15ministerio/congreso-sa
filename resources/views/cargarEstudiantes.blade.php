
    @extends('layouts.app')

@section('title', 'Cargar estudiantes')

@section('content')

<div style="
    max-width:1000px;
    margin:40px auto;
">

    <div style="
        background:white;
        padding:35px;
        border-radius:20px;
        box-shadow:6px 6px 0px #8CE1D4;
    ">

        <h1 style="
            font-size:2rem;
            font-weight:bold;
            margin-bottom:30px;
        ">
            Cargar estudiantes
        </h1>

        @if(session('success'))

            <div style="
                background:#d4edda;
                color:#155724;
                padding:15px;
                border-radius:8px;
                margin-bottom:20px;
            ">

                {{ session('success') }}

            </div>

        @endif

        <form method="POST"
              action="/cargar-estudiantes">

            @csrf

            <!-- ÁREA Y ESCUELA -->

            <div class="row">

                <div class="col-md-4">

                    <label>Área</label>

                    <select name="area"
                            id="area"
                            class="form-control"
                            required>

                        <option value="">
                            Seleccionar...
                        </option>

                        <option value="DEM">DEM</option>
                        <option value="DEA">DEA</option>
                        <option value="DENS">DENS</option>
                        <option value="DET">DET</option>
                        <option value="PRIV">PRIV</option>

                    </select>

                </div>

                <div class="col-md-8">

                    <label>Escuela</label>

                    <input type="text"
                           id="busquedaEscuela"
                           name="escuela"
                           class="form-control"
                           autocomplete="off"
                           placeholder="Escriba palabras clave..."
                           required>

                    <div id="resultadosEscuelas"
                         style="
                            border:1px solid #ccc;
                            border-top:none;
                            max-height:200px;
                            overflow-y:auto;
                            background:white;
                         ">
                    </div>

                </div>

            </div>

            <hr style="margin:35px 0;">

            <!-- ESTUDIANTES -->

            <div id="contenedorEstudiantes">

            </div>

            <button type="button"
                    id="btnAgregar"
                    class="btn btn-secondary mt-3">

                + Agregar estudiante

            </button>

            <div class="mt-4">

                <button class="btn btn-dark">

                    Guardar estudiantes

                </button>

            </div>

        </form>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    let contador = 0;

    const contenedor =
        document.getElementById('contenedorEstudiantes');

    const btnAgregar =
        document.getElementById('btnAgregar');

    agregarEstudiante();

    btnAgregar.addEventListener('click', function () {

        agregarEstudiante();

    });

    function agregarEstudiante() {

        const html = `

            <div class="card mt-4">

                <div class="card-body">

                    <h5>
                        Estudiante ${contador + 1}
                    </h5>

                    <div class="row mt-3">

                        <div class="col-md-3">

                            <label>Nombre</label>

                            <input type="text"
                                   name="estudiantes[${contador}][nombre]"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-3">

                            <label>Apellido</label>

                            <input type="text"
                                   name="estudiantes[${contador}][apellido]"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-3">

                            <label>DNI</label>

                            <input type="text"
                                   class="form-control dni-estudiante"
                                   name="estudiantes[${contador}][dni]"
                                   required>

                        </div>

                        <div class="col-md-3">

                            <label>Nivel</label>

                            <select name="estudiantes[${contador}][nivel]"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Seleccionar...
                                </option>

                                <option value="Nivel 1">
                                    Nivel 1
                                </option>

                                <option value="Nivel 2">
                                    Nivel 2
                                </option>

                                <option value="Nivel 3">
                                    Nivel 3
                                </option>

                                <option value="Nivel 4">
                                    Nivel 4
                                </option>

                                <option value="Nivel 5">
                                    Nivel 5
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        `;

        contenedor.insertAdjacentHTML('beforeend', html);

        contador++;

        activarLimpiezaDNI();

    }

    function activarLimpiezaDNI() {

        document.querySelectorAll('.dni-estudiante')
            .forEach(function (input) {

                input.addEventListener('input', function () {

                    this.value =
                        this.value.replace(/\D/g, '');

                });

            });

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

            div.style.padding = '10px';

            div.style.cursor = 'pointer';

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
