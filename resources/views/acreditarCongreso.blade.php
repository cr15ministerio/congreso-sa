@extends('layouts.app')

@section('title', 'Acreditación Congreso')

@section('content')

<div class="container">

    <div class="card p-4 mt-4">

        <h2 class="mb-4">
            Acreditación Congreso
        </h2>

        <p>
            Ingresá tu DNI y correo electrónico con que te inscribiste para registrar tu asistencia.
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
                    required>

            </div>

            <div class="mb-3">

               <label>Email</label>

<input
    type="email"
    name="email"
    class="form-control"
    required>

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