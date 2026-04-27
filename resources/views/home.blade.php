@extends('layouts.app')

@section('title', 'Congreso Secundaria Aprende')

@push('styles')
<style>

.container-home {
    max-width: 900px;
    margin: 0 auto;
}

/* BLOQUE CAJA */
.bloque-convocatoria {
    background: #f5f5f5;
    border-radius: 20px;
    padding: 30px;
    margin-top: 30px;
    position: relative;
    box-shadow: 6px 6px 0px #8CE1D4;
}

/* TEXTO */
.texto-home {
    margin-top: 30px;
    font-family: 'Nunito', sans-serif;
    font-size: 1rem;
    line-height: 1.6;
    color: #2c3e50;
}



</style>
@endpush

@section('content')

<div class="container-home">

    <!-- BLOQUE DESTACADO -->
    <div class="bloque-convocatoria">
        <h2 class="titulo-resaltado">
            <span>Convocatoria de participación</span>
        </h2>

        <h2 class="titulo-resaltado">
            <span>y presentación de experiencias</span>
        </h2>
    </div>

    <!-- TEXTO -->
    <div class="texto-home">
        <p>
            El Congreso de Secundaria Aprende será un espacio de encuentro, intercambio y reflexión...
        </p>

        <p>
            La propuesta recupera el trabajo desarrollado por las instituciones...
        </p>
    </div>

</div>

@endsection