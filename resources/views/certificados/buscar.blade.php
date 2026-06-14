@extends('layouts.app')

@section('title', 'Certificados')

@section('content')

<div class="container">

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
                class="btn btn-primary">

                Buscar certificados

            </button>

        </form>

    </div>

</div>

@endsection