@extends('layouts.app')

@section('title', 'QR y acreditaciones')

@section('content')

<div class="container">

    <h2 class="titulo-resaltado mb-4">
        <span>QR y acreditaciones</span>
    </h2>

    <div class="card p-4">

        <h4>Acreditación Congreso</h4>

        <div class="mt-3">

            <a href="{{ url('/acreditar/congreso/2026-06-17') }}"
               target="_blank"
               class="btn btn-primary">
                Día 1
            </a>

            <a href="{{ url('/acreditar/congreso/2026-06-18') }}"
               target="_blank"
               class="btn btn-primary ms-2">
                Día 2
            </a>

        </div>

    </div>

</div>

@endsection