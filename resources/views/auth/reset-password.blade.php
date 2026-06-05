@extends('layouts.app')

@section('title', 'Nueva contraseña')

@push('styles')
<style>

.reset-box {
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

<div class="reset-box">

    <h2 class="titulo-resaltado">
        <span>Nueva contraseña</span>
    </h2>

    <p class="mb-3 text-muted">
        Ingresá tu nueva contraseña para completar el proceso de recuperación.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token -->
        <input type="hidden"
               name="token"
               value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="mt-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', $request->email) }}"
                required
                readonly
            >

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div class="mt-3">
            <label>Nueva contraseña</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required
                autocomplete="new-password"
            >

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Confirmación -->
        <div class="mt-3">
            <label>Confirmar contraseña</label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required
                autocomplete="new-password"
            >

            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">

            <a href="{{ route('login') }}">
                Volver al ingreso
            </a>

            <button type="submit" class="btn btn-dark">
                Guardar contraseña
            </button>

        </div>

    </form>

</div>

@endsection