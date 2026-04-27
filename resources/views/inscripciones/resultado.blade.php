@extends('layouts.app')

@section('title', 'Resultado de inscripción')

@push('styles')
<style>

.resultado-box {
    max-width: 700px;
    margin: 0px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #FFD000;
}

.nombre-usuario {
    font-family: 'Nunito', sans-serif;
    font-size: 1.3rem;
    margin-bottom: 15px;
}

/* tarjeta de taller */
.taller-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    margin-bottom: 15px;
}

.taller-card h5 {
    font-weight: 700;
}

.taller-meta {
    font-size: 0.9rem;
    color: #555;
}

/* Día 1 (celeste) */
.taller-dia1 {
    background-color: #E6F7F4;
    border-left: 6px solid #6ED3C5;
}

/* Día 2 (amarillo) */
.taller-dia2 {
    background-color: #FFF8D6;
    border-left: 6px solid #FFD000;
}

.titulo-resaltado span {
    position: relative;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    color: #0B2B3C;
    display: inline-block;
}

/* fondo amarillo */
.titulo-resaltado span::before {
    content: "";
    position: absolute;
     left: -6px;

    right: -6px;

    bottom: 0.15em;   /* 👈 más abajo */

    height: 0.45em;   /* 👈 más fino */

    background: #FFD000;
    z-index: -2;
}

/* fondo celeste (ligeramente corrido) */
.titulo-resaltado span::after {
    content: "";
    position: absolute;
    left: -2px;

    right: -2px;

    bottom: 0em;  /* 👈 un poco más abajo que el amarillo */

    height: 0.45em;   /* 👈 mismo grosor */

    background: #8CE1D4;
    z-index: -1;
}

</style>
@endpush

@section('content')

<div class="resultado-box">

    <h2 class="titulo-resaltado">
        <span>Tu inscripción</span>
    </h2>

    <div class="nombre-usuario">
        {{ $user->nombre }} {{ $user->apellido }}
    </div>

    @if($inscripciones->count() == 0)

        <div class="alert alert-warning">
            No estás inscripto en ningún taller.
        </div>

    @else

        @foreach($inscripciones as $i)
           <div class="card taller-card 
    {{ $i->taller->dia == '2026-06-17' ? 'taller-dia1' : 'taller-dia2' }}">
                <div class="card-body">

                    <h5>{{ $i->taller->titulo }}</h5>

                     <span class="badge 
                        {{ $i->taller->dia == '2026-06-17' ? 'bg-info' : 'bg-warning text-dark' }}">
                        {{ \Carbon\Carbon::parse($i->taller->dia)->format('d-m-Y') }}
                    </span>

                    <div class="taller-meta">
                        <!-- {{ \Carbon\Carbon::parse($i->taller->dia)->format('d-m-Y') }} · -->
                          <b>
                                {{ \Carbon\Carbon::parse($i->taller->hora_inicio)->format('H:i') }} 
- 
{{ \Carbon\Carbon::parse($i->taller->hora_fin)->format('H:i') }}

                          </b>
                        
                    </div>

                    <div class="taller-meta">
                        <b>Lugar:</b> {{ $i->taller->aula }}
                    </div>

                </div>
            </div>
        @endforeach

    @endif

    <div class="mt-4 d-flex justify-content-between">
        <a href="/consultar-inscripcion" class="text-decoration-none">
            Nueva consulta
        </a>

        <a href="{{ route('talleres') }}" class="btn btn-outline-dark">
            Ver talleres
        </a>
    </div>

</div>

@endsection