@extends('layouts.app')

@section('title', 'Acreditación Congreso')

@section('content')

<div class="container">

    <div class="card p-4 mt-4">

        <h2 class="mb-4">
            Acreditación Congreso
        </h2>

        <p>
    Ingresá tu DNI y, si corresponde, el correo electrónico con que te inscribiste para registrar tu asistencia.
</p>

<div class="alert alert-warning">
    ⚠️ Si estás registrado como <b>estudiante</b>, ingresá únicamente tu DNI y dejá en blanco el campo <b>Email</b>.
</div>


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
                    required>

            </div>

            <div class="mb-3">

               <label>Email</label>

<input
    type="email"
    name="email"
    class="form-control">

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Registrar asistencia

            </button>

        </form>

    </div>

</div>

@endsection