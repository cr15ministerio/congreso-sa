

@extends('layouts.app')

@section('title', 'Talleres')

@push('styles')
<style>

.talleres-box {
    max-width: 900px;
    margin: 60px auto;
}

.card-espera {

    background: white;

    border-radius: 24px;

    padding: 60px 50px;

    text-align: center;

    box-shadow: 8px 8px 0px #8CE1D4;
}

.card-espera h1 {

    font-size: 2.3rem;

    font-weight: 800;

    margin-bottom: 20px;

}

.card-espera p {

    font-size: 1.1rem;

    color: #555;

    line-height: 1.7;

    max-width: 700px;

    margin: 0 auto 15px auto;

}

.icono-talleres {

    font-size: 4rem;

    margin-bottom: 25px;

}

.badge-fecha {

    display:inline-block;

    margin-top:20px;

    background:#f2f2f2;

    border-radius:30px;

    padding:10px 18px;

    font-size:0.95rem;

    color:#444;

}

</style>
@endpush

@section('content')

<div class="talleres-box">

    <div class="card-espera">

        <div class="icono-talleres">
            🛠️
        </div>

        <h1>
            Los talleres todavía no están publicados
        </h1>

        <p>
            Estamos terminando de evaluar y organizar
            las propuestas recibidas para el Congreso.
        </p>

        <p>
            Próximamente vas a poder consultar
            la programación completa e inscribirte
            a los talleres desde esta sección.
        </p>

        <div class="badge-fecha">

            Publicación próxima

        </div>

    </div>

</div>

@endsection