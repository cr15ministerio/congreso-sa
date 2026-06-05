@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@push('styles')
<style>

.recuperar-box {
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

<div class="recuperar-box">

    <h2 class="titulo-resaltado">
        <span>Recuperar contraseña</span>
    </h2>

    <p class="mb-3 text-muted">
        Ingresá el correo electrónico con el que te registraste y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <!-- @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif -->

    @if (session('status'))
    <div class="alert alert-success">
        Te enviamos un correo electrónico con instrucciones para restablecer tu contraseña.
    </div>
@endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mt-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
                autofocus
            >

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">

            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm text-start">
                Volver al ingreso
            </a>

            <button type="submit" class="btn btn-dark">
                Enviar enlace
            </button>

        </div>

    </form>

</div>

@endsection