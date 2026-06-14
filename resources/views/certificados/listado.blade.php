@extends('layouts.app')

@section('title', 'Certificados disponibles')

@section('content')

<div class="container">

    <div class="card p-4 mt-4">

        <h2>
            Resultados de certificados para:
        </h2>

        <p>
            {{ $user->nombre }}
            {{ $user->apellido }}
        </p>

        <hr>

        <h4>
            Congreso
        </h4>

        @forelse($certificadosCongreso as $cert)

            <div class="mb-3">

                Congreso Secundaria Aprende
                -
                {{ \Carbon\Carbon::parse($cert->fecha_congreso)->format('d-m-Y') }}

                <br>

               <a
    href="{{ url('/certificado/congreso/'.$user->id.'/'.$cert->fecha_congreso) }}"
    target="_blank"
    class="btn btn-success btn-sm mt-1">

    Descargar

</a>

            </div>

        @empty

            <p>
                No hay certificados de asistencia al congreso.
            </p>

        @endforelse

        <hr>

        <h4>
            Talleres
        </h4>

        @forelse($certificadosTalleres as $cert)

            <div class="mb-3">

                {{ $cert->titulo }}

                <br>

               <a
    href="{{ url('/certificado/taller/'.$user->id.'/'.$cert->id) }}"
    target="_blank"
    class="btn btn-success btn-sm mt-1">

    Descargar

</a>

            </div>

        @empty

            <p>
                No hay certificados de asistencia a talleres.
            </p>

        @endforelse

    </div>

</div>

@endsection