@extends('layouts.app')

@section('title', 'Registro')

@push('styles')
<style>

.registro-box {
    max-width: 500px;
    margin: 10px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

.registro-box h2 {
    font-family: 'Nunito', sans-serif;
    font-weight: 700;
    margin-bottom: 20px;
}

</style>
@endpush

@section('content')


    <div class="registro-box">

    <h2 class="titulo-resaltado">
        <span>Registro</span>
    </h2>
    <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>DNI</label>
            <input type="text" name="DNI" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
    </div>

    <!-- NUEVO -->
    <div class="row mt-3">
        <div class="col-md-12">
            <label>Pertenencia</label>
            <select name="tipo_pertenencia" id="tipo_pertenencia" class="form-control" required>
                <option value="">Seleccionar...</option>
                <option value="escuela">Escuela</option>
                <option value="organizacion">Organización</option>
                <option value="ministerio">Ministerio</option>
            </select>
        </div>
    </div>

    <!-- BLOQUE ESCUELA -->
    <div id="bloqueEscuela" style="display:none;">

        <div class="row mt-3">
            <div class="col-md-6">
                <label>Área</label>
                <select name="area" id="area" class="form-control">
                    <option value="">Seleccionar área...</option>
                    <option value="DEM">DEM</option>
                    <option value="DEA">DEA</option>
                    <option value="DENS">DENS</option>
                    <option value="PRIVADA">PRIVADA</option>
                    <option value="TECNICA">TÉCNICA</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Escuela</label>
                <select name="escuela" id="escuela" class="form-control">
                    <option value="">Seleccionar escuela...</option>
                </select>
            </div>
        </div>

    </div>

    <!-- BLOQUE ORGANIZACIÓN -->
    <div id="bloqueOrganizacion" style="display:none;">
        <div class="row mt-3">
            <div class="col-md-12">
                <label>Nombre de la organización</label>
                <input type="text" 
                       name="organizacion" 
                       class="form-control">
            </div>
        </div>
    </div>

    <!-- BLOQUE MINISTERIO -->
    <div id="bloqueMinisterio" style="display:none;">
        <div class="row mt-3">
            <div class="col-md-12">
                <label>Área / dependencia del ministerio</label>
                <input type="text" 
                       name="dependencia_ministerio" 
                       class="form-control">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Contraseña</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-6">
            <label>Confirmar contraseña</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>

            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('login') }}" class="text-decoration-none">
            ¿Ya estás registrado?
        </a>

        <button class="btn btn-dark ms-3">
            Registrarse
        </button>
    </div>
</form>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tipo = document.getElementById('tipo_pertenencia');

    const bloqueEscuela = document.getElementById('bloqueEscuela');
    const bloqueOrganizacion = document.getElementById('bloqueOrganizacion');
    const bloqueMinisterio = document.getElementById('bloqueMinisterio');

    tipo.addEventListener('change', function () {

        bloqueEscuela.style.display = 'none';
        bloqueOrganizacion.style.display = 'none';
        bloqueMinisterio.style.display = 'none';

        if (this.value === 'escuela') {
            bloqueEscuela.style.display = 'block';
        }

        if (this.value === 'organizacion') {
            bloqueOrganizacion.style.display = 'block';
        }

        if (this.value === 'ministerio') {
            bloqueMinisterio.style.display = 'block';
        }
    });

    // ESCUELAS DE EJEMPLO
    const escuelasPorArea = {
        DEM: [
            'Escuela 1 DEM',
            'Escuela 2 DEM'
        ],
        DEA: [
            'Escuela 1 DEA',
            'Escuela 2 DEA'
        ],
        DENS: [
            'Escuela 1 DENS',
            'Escuela 2 DENS'
        ],
        PRIVADA: [
            'Escuela 1 PRIVADA',
            'Escuela 2 PRIVADA'
        ],
        TECNICA: [
            'Escuela 1 TÉCNICA',
            'Escuela 2 TÉCNICA'
        ]
    };

    const areaSelect = document.getElementById('area');
    const escuelaSelect = document.getElementById('escuela');

    areaSelect.addEventListener('change', function () {

        const area = this.value;

        escuelaSelect.innerHTML =
            '<option value="">Seleccionar escuela...</option>';

        if (escuelasPorArea[area]) {

            escuelasPorArea[area].forEach(function (escuela) {

                const option = document.createElement('option');

                option.value = escuela;
                option.textContent = escuela;

                escuelaSelect.appendChild(option);

            });

        }

    });

});

</script>
    </div>

@endsection
