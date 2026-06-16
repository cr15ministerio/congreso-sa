@extends('layouts.app')

@section('title', 'Certificados')

@section('content')

<style>
     /* Estilo del placeholder */
    input::placeholder {
        font-size:11px;       /* Versalitas */
        font-family:Verdana;
        color: #888;                    /* Color gris */
        letter-spacing: 1px;            /* Espaciado opcional */
    }
</style>

<div class="container">

<div style="max-width:700px;margin:0 auto;">

    <div class="card p-4 mt-4">

        <h2>
            Consultar certificados
        </h2>

        <p>
            Ingresá tu DNI y correo electrónico.
        </p>

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST">

            @csrf

            
            <div class="mb-3">

                <label>DNI</label>

                <input
                    type="text"
                    name="dni"
                    class="form-control"
                    placeholder="Sin puntos ni espacios"
                    required>

            </div>

            <div class="mb-3">

                   

                <label>Email</label>

                 

                <input
                    type="email"
                    name="email"
                    placeholder="Si sos ESTUDIANTE dejá este campo en blanco"
                    class="form-control"
                    >
                   
            </div>
             <div class="alert alert-info text-center mb-3">
            ⚠️ Si sos <b>ESTUDIANTE</b>, ingresá únicamente tu <b>DNI</b> y dejá el campo <b><i>Email</i></b> en blanco.
                    </div>

            <button
                class="btn btn-primary">

                Buscar certificados

            </button>
</div>
        </form>

    </div>

</div>

@endsection