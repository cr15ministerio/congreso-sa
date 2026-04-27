@extends('layouts.app')

@section('title', 'Registro')

@push('styles')
<style>

.registro-box {
    max-width: 500px;
    margin: 10px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 6px 6px 0px #8CE1D4;
}

.registro-box h2 {
    font-family: 'Nunito', sans-serif;
    font-weight: 700;
    margin-bottom: 20px;
}

</style>
@endpush

@section('content')


    <div class="registro-box">

    <h2 class="titulo-resaltado">
        <span>Registro</span>
    </h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <!-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> -->

       <div class="row mt-3">
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label>Apellido</label>
        <input type="text" name="apellido" class="form-control" required>
    </div>
</div>

       <div class="row mt-3">
    <div class="col-md-6">
        <label>DNI</label>
        <input type="text" name="DNI" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
</div>

        <div class="row mt-3">
    <div class="col-md-6">
        <label>Contraseña</label>
        <input type="password" 
               name="password" 
               class="form-control" 
               required>
        
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-6">
        <label>Confirmar contraseña</label>
        <input type="password" 
               name="password_confirmation" 
               class="form-control" 
               required>

        @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="text-decoration-none">
                ¿Ya estás registrado?
            </a>
          <button class="btn btn-dark ms-3">
    Registrarse
</button>
        </div>
    </form>
    </div>

@endsection
