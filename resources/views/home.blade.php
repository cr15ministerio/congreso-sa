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
            <span>Información general sobre el congreso</span>
        </h2>

        <!-- <h2 class="titulo-resaltado">
            <span>y presentación de experiencias</span>
        </h2> -->
    </div>

   <!-- TEXTO -->
<div class="texto-home">
    <p>
        El <b>Congreso de Secundaria Aprende </b> será un espacio de <i>encuentro, intercambio y reflexión </i> entre actores de la comunidad educativa, orientado a <b>socializar experiencias y fortalecer los procesos de transformación de la escuela secundaria</b>.
    </p>

    <p>
        La propuesta recupera el trabajo desarrollado por las instituciones en torno a <b><i>Secundaria Aprende</i></b> y busca generar una instancia ampliada de participación, aprendizaje entre pares y construcción de nuevas ideas para la <b>mejora de la enseñanza y la organización escolar</b>.
    </p>

    <p>
        La jornada incluirá <b>mesas temáticas, stands de experiencias, talleres, conversatorios</b> y otros espacios de intercambio y formación.
    </p>
    <p>
        El Congreso está destinado a <b>equipos directivos y docentes de escuelas secundarias,
supervisores, equipos técnicos, estudiantes de profesorados y otros actores de la
comunidad educativa</b> interesados en la transformación de la escuela secundaria. 
</p>
<p>
Están invitados a participar del <b>Congreso</b> todos los actores de la comunidad educativa como
oyentes. Asimismo, se convoca especialmente a las escuelas que están implementando
<b><i>Secundaria Aprende</i></b>, escuelas pioneras (cohorte 2025) y escuelas cohorte 2026, a
presentar experiencias para su socialización en las distintas modalidades previstas.
</p>
</div>

</div>

@endsection