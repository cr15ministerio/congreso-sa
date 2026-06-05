@extends('layouts.app')

@section('title', 'Ingresar')

@push('styles')
<style>

.login-box {
    max-width: 500px;
    margin: 20px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

</style>
@endpush

@section('content')

<div class="login-box">

    <h2 class="titulo-resaltado">
        <span>Ingresar</span>
    </h2>

    <p class="mb-3 text-muted">
        Ingresá para inscribirte en los talleres del congreso.
    </p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

       <div class="d-flex justify-content-between align-items-center mt-4">

                <div class="d-flex flex-column gap-2">

                    <a href="{{ route('register') }}"
                   class="btn btn-outline-primary btn-sm text-start">
                       ➕ Crear cuenta
                    </a>

                    <a href="{{ route('password.request') }}"
                   class="btn btn-outline-secondary btn-sm text-start">
                       🔑 Recuperar contraseña
                    </a>

                </div>

    <button class="btn btn-dark">
        Ingresar
    </button>

</div>

    </form>

</div>

@endsection