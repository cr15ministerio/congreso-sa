@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('title', 'Participantes registrados')

@section('content')

<div style="max-width:1200px; margin:30px auto;">

    <h2 class="titulo-resaltado mb-4">
        <span>Participantes registrados</span>
    </h2>

    <div class="table-responsive bg-white p-4 rounded shadow-sm">

        <table id="tablaParticipantes" class="table table-bordered table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Rol congreso</th>
                    <th>Institución / escuela</th>
                    <th>Rol institucional</th>
                </tr>
            </thead>

            <tbody>
                @foreach($participantes as $p)
                    <tr>
                        <td>{{ $p->apellido }}</td>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->DNI }}</td>
                        <td>
                            @if($p->rol == 'estudiante')

        —

    @else

        {{ $p->email }}

    @endif
                           
                        </td>
                        <td>{{ ucfirst(str_replace('_', ' ', $p->rol)) }}</td>
                        <td>{{ $p->escuela ?? '—' }}</td>
                        <td>{{ $p->rol_en_escuela ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@push('scripts')
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function () {
    $('#tablaParticipantes').DataTable({
        pageLength: 25,
        order: [[0, 'asc'], [1, 'asc']],

        dom: 'Bfrtip',

        buttons: [
            {
                extend: 'csvHtml5',
                text: '📄 Descargar CSV',
                filename: 'participantes_congreso'
            },
            {
                extend: 'excelHtml5',
                text: '📊 Descargar Excel',
                filename: 'participantes_congreso'
            }
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
        }
    });
});
</script>
@endpush

@endsection