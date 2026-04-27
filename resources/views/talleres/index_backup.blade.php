<!-- <!DOCTYPE html>
<html>
<head> -->


@extends('layouts.app')

@section('content')

     <title>Talleres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f7f7;
        }

        .titulo-principal {
            font-weight: 700;
        }

        .bloque-dia {
            margin-top: 40px;
        }

        .card-taller {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.1s ease;
            height: 100%;
        }

        .card-taller:hover {
            transform: translateY(-3px);
        }

        .tag-dia {
            display: inline-block;
            background: #ffe066;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-inscripto {
            background-color: #20c997;
            border: none;
        }

        .btn-sin-cupo {
            background-color: #adb5bd;
            border: none;
        }

        .mi-taller {
    border: 2px solid #ffc107;
}

.fecha-titulo {
    font-weight: 800;
    font-size: 1.6rem;
    border-left: 6px solid #00bcd4;
    padding-left: 10px;
    margin-top: 30px;
}
    </style>
<!-- </head> -->

<body class="container py-5">

<h1 class="mb-4 titulo-principal">Talleres</h1>

<!-- @if(count($misInscripciones) > 0)
<div class="alert alert-info">
    Ya estás inscripto en un taller. Podés cambiarlo seleccionando otro.
</div>
@endif -->

@if($inscripciones17)
<div class="alert alert-info">
    Ya estás inscripto en un taller de este día. Podés cambiarlo seleccionando otro.
</div>
@endif

<!-- ===== 17 ===== -->
<div id="dia17" class="bloque-dia">
    <!-- <h3 class="mb-3">17 de junio</h3> -->
    <h2 class="fecha-titulo">{{ ucfirst($talleres17Label) }}</h2>
                        <span class="tag-dia">14:00 – 16:30</span>

    <div class="row mt-3 g-3">
        @foreach($talleres17 as $t)
         <!-- Modal -->
                            <div class="modal fade" id="modalTaller{{ $t->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $t->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>{{ $t->descripcion }}</p>
                        <p><strong>Aula:</strong> {{ $t->aula }}</p>
                        <p><strong>Día:</strong> {{ \Carbon\Carbon::parse($t->dia)->format('d-m-Y') }}</p>
                        <p><strong>Horario:</strong> {{ $t->hora_inicio }} - {{ $t->hora_fin }}</p>
                        <p><strong>Cupo disponible:</strong> {{ $t->cupo - $t->inscriptos }}</p>
                    </div>

                    <div class="modal-footer">

                        @if(in_array($t->id, $misInscripciones))
                            <button class="btn btn-success">Ya inscripto</button>

                        @elseif($t->inscriptos >= $t->cupo)
                            <button class="btn btn-secondary">Sin cupo</button>

                        @else
                            <form method="POST" action="{{ route('inscribirse', $t->id) }}">
                                @csrf
                                <button class="btn btn-primary">Inscribirme</button>
                            </form>
                        @endif

                    </div>

                    </div>
                </div>
                </div>
             <!-- fin del modal -->
        <div class="col-6 col-md-4 col-lg-2">
            <!-- <div class="card card-taller p-3 position-relative"> -->
                <div class="card card-taller p-3 {{ in_array($t->id, $misInscripciones) ? 'mi-taller' : '' }}">

    @if(in_array($t->id, $misInscripciones))

        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">

            Mi taller

        </span>

    @endif

                <h6 class="fw-bold">{{ $t->titulo }}</h6>
                    <!-- <p class="text-muted small">
                        {{ $t->descripcion }}
                    </p> -->
                <p class="small text-muted">Lugar: {{ $t->aula }}</p>

                <button class="btn btn-outline-dark btn-sm w-100 mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTaller{{ $t->id }}">
                    Ver más
                </button>
                
                <p class="mb-3">
                    <strong>Cupo disponible:</strong>
                    {{ $t->cupo - $t->inscriptos }}
                </p>

                @if(in_array($t->id, $misInscripciones))
                    <button class="btn btn-inscripto w-100">Ya inscripto</button>

                @elseif($t->inscriptos >= $t->cupo)
                    <button class="btn btn-sin-cupo w-100">Sin cupo</button>

                @else
                    <form method="POST" action="{{ route('inscribirse', $t->id) }}">
                        @csrf
                        <button class="btn btn-primary w-100">Inscribirse</button>
                    </form>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</div>

<br>

@if($inscripciones18)
<div class="alert alert-info">
    Ya estás inscripto en un taller de este día. Podés cambiarlo seleccionando otro.
</div>
@endif

<!-- ===== 18 ===== -->
<div id="dia18" class="bloque-dia">
<h2 class="fecha-titulo">{{ ucfirst($talleres18Label) }}</h2>
                        <span class="tag-dia">9:00 – 11:30</span>

    <div class="row mt-3 g-3">
        @foreach($talleres18 as $t)
         <!-- Modal -->
                            <div class="modal fade" id="modalTaller{{ $t->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ $t->titulo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>{{ $t->descripcion }}</p>
                        <p><strong>Aula:</strong> {{ $t->aula }}</p>
                        <p><strong>Día:</strong> {{ \Carbon\Carbon::parse($t->dia)->format('d-m-Y') }}</p>
                        <p><strong>Horario:</strong> {{ $t->hora_inicio }} - {{ $t->hora_fin }}</p>
                        <p><strong>Cupo disponible:</strong> {{ $t->cupo - $t->inscriptos }}</p>
                    </div>

                    <div class="modal-footer">

                        @if(in_array($t->id, $misInscripciones))
                            <button class="btn btn-success">Ya inscripto</button>

                        @elseif($t->inscriptos >= $t->cupo)
                            <button class="btn btn-secondary">Sin cupo</button>

                        @else
                            <form method="POST" action="{{ route('inscribirse', $t->id) }}">
                                @csrf
                                <button class="btn btn-primary">Inscribirme</button>
                            </form>
                        @endif

                    </div>

                    </div>
                </div>
                </div>
             <!-- fin del modal -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card card-taller p-3 {{ in_array($t->id, $misInscripciones) ? 'mi-taller' : '' }}">

    @if(in_array($t->id, $misInscripciones))

        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">

            Mi taller

        </span>

    @endif

           

              <h6 class="fw-bold">{{ $t->titulo }}</h6>
                    <!-- <p class="text-muted small">
                        {{ $t->descripcion }}
                    </p> -->
                <p class="small text-muted">Aula {{ $t->aula }}</p>

                <button class="btn btn-outline-dark btn-sm w-100 mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTaller{{ $t->id }}">
                    Ver más
                </button>

                <p class="mb-3">
                    <strong>Cupo disponible:</strong>
                    {{ $t->cupo - $t->inscriptos }}
                </p>

                @if(in_array($t->id, $misInscripciones))
                    <button class="btn btn-inscripto w-100">Ya inscripto</button>

                @elseif($t->inscriptos >= $t->cupo)
                    <button class="btn btn-sin-cupo w-100">Sin cupo</button>

                @else
                    <form method="POST" action="{{ route('inscribirse', $t->id) }}">
                        @csrf
                        <button class="btn btn-primary w-100">Inscribirse</button>
                    </form>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

@endsection
   


<!--
</html> -->