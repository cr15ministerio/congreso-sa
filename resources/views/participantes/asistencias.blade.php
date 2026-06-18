@extends('layouts.app')

@section('title', 'Asistencias')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">
        Asistencias
    </h2>

    <ul class="nav nav-tabs" id="tabsAsistencias" role="tablist">

        <li class="nav-item" role="presentation">
            <button
                class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#congreso"
                type="button">

                Congreso

            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#talleres"
                type="button">

                Talleres

            </button>
        </li>

    </ul>

    <div class="tab-content border border-top-0 p-4 bg-white">

        {{-- CONGRESO --}}
        <div
            class="tab-pane fade show active"
            id="congreso">

            <div class="mb-3">

                <label class="form-label">
                    Día
                </label>

                <select
                    id="selectorCongreso"
                    class="form-select">

                    <option value="dia17">
                        Miércoles 17 de junio
                    </option>

                    <option value="dia18">
                        Jueves 18 de junio
                    </option>

                </select>

            </div>

            <div id="dia17">

                <h5>
                    Asistencias registradas:
                    {{ count($asistenciasCongreso17) }}
                </h5>

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Hora</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($asistenciasCongreso17 as $a)

                        <tr>
                            <td>{{ $a->DNI }}</td>
                            <td>{{ $a->apellido }}</td>
                            <td>{{ $a->nombre }}</td>
                            <td>{{ $a->rol }}</td>
                            <td>{{ $a->fecha_hora_registro }}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div
                id="dia18"
                style="display:none;">

                <h5>
                    Asistencias registradas:
                    {{ count($asistenciasCongreso18) }}
                </h5>

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Hora</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($asistenciasCongreso18 as $a)

                        <tr>
                            <td>{{ $a->DNI }}</td>
                            <td>{{ $a->apellido }}</td>
                            <td>{{ $a->nombre }}</td>
                            <td>{{ $a->rol }}</td>
                            <td>{{ $a->fecha_hora_registro }}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        {{-- TALLERES --}}
        <div
            class="tab-pane fade"
            id="talleres">

            <div class="mb-3">

                <label class="form-label">
                    Taller
                </label>

                <select
                    class="form-select"
                    id="selectorTaller">

                    <optgroup label="Miércoles 17">

                        @foreach($talleres17 as $taller)

                            <option value="{{ $taller->id }}">
                                {{ $taller->titulo }}
                            </option>

                        @endforeach

                    </optgroup>

                    <optgroup label="Jueves 18">

                        @foreach($talleres18 as $taller)

                            <option value="{{ $taller->id }}">
                                {{ $taller->titulo }}
                            </option>

                        @endforeach

                    </optgroup>

                </select>

            </div>

            <div class="alert alert-info">

                Próximo paso:
                mostrar aquí los asistentes del taller seleccionado.

            </div>

        </div>

    </div>

</div>

<script>

document
.getElementById('selectorCongreso')
.addEventListener('change', function() {

    document.getElementById('dia17').style.display = 'none';
    document.getElementById('dia18').style.display = 'none';

    document.getElementById(
        this.value
    ).style.display = 'block';

});

</script>

@endsection