@extends('layouts.app')

@section('title', 'QR y acreditaciones')

@section('content')

<div class="container">

    <h2 class="titulo-resaltado mb-4">
        <span>QR y acreditaciones</span>
    </h2>

    <div class="card p-4 mb-4">

        <h4>Congreso</h4>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>QR</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Día 1</td>
                    <td>
                        <a href="{{ url('/ver-qr/congreso/1') }}"
                           target="_blank"
                           class="btn btn-primary btn-sm">
                            Ver QR
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Día 2</td>
                    <td>
                        <a href="{{ url('/ver-qr/congreso/2') }}"
                           target="_blank"
                           class="btn btn-primary btn-sm">
                            Ver QR
                        </a>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <div class="card p-4">

        <h4>Talleres</h4>

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Taller</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>QR</th>
                </tr>
            </thead>

            <tbody>

            @foreach($talleres as $taller)

                <tr>

                    <td>{{ $taller->id }}</td>

                    <td>{{ $taller->titulo }}</td>

                    <td>{{ $taller->dia }}</td>

                    <td>
                        {{ substr($taller->hora_inicio,0,5) }}
                    </td>

                    <td>

                        <a href="{{ url('/ver-qr/taller/'.$taller->id) }}"
   target="_blank"
   class="btn btn-primary btn-sm">

    Ver QR

</a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection