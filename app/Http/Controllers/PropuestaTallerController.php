<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropuestaTaller;
use App\Models\Taller;
use App\Models\PropuestaTallerista;

class PropuestaTallerController extends Controller
{
    public function create()
    {
        return view('propuestas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'resumen' => 'required',
            'descripcion' => 'required',
            'jornada' => 'required',
        ]);

        $propuesta = PropuestaTaller::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'resumen' => $request->resumen,
            'descripcion' => $request->descripcion,
            'jornada' => $request->jornada,
            'materiales' => implode(',', $request->materiales ?? []),
            'solicita_computadoras' => $request->has('solicita_computadoras'),
            'estado' => 'pendiente',
        ]);

        if ($request->has('talleristas')) {

            foreach ($request->talleristas as $t) {

                PropuestaTallerista::create([
                    'propuesta_taller_id' => $propuesta->id,
                    'nombre' => $t['nombre'],
                    'apellido' => $t['apellido'],
                    'email' => $t['email'],
                    'tipo' => $t['tipo'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'La propuesta ha sido enviada correctamente para su evaluación. Más adelante nos comunicaremos por correo electrónico para informar al equipo sobre la resolución del comité de evaluación de talleres. Muchas gracias.');
    }

    public function index()
{
    if (auth()->user()->rol != 'admin') {
    abort(403);
}
    $propuestas = PropuestaTaller::with('talleristas')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('propuestas.index', compact('propuestas'));
}

public function cambiarEstado(Request $request, PropuestaTaller $propuesta)
{
    if (auth()->user()->rol != 'admin') {
        abort(403);
    }

    $request->validate([
        'estado' => 'required|in:pendiente,aceptada,rechazada'
    ]);

    $propuesta->update([
        'estado' => $request->estado
    ]);

    return back()->with(
        'success',
        'Estado actualizado correctamente.'
    );
}

public function edit(PropuestaTaller $propuesta)
{
    if (auth()->user()->rol != 'admin') {
        abort(403);
    }

    return view(
        'propuestas.edit',
        compact('propuesta')
    );
}

public function update(Request $request, PropuestaTaller $propuesta)
{
    if (auth()->user()->rol != 'admin') {
        abort(403);
    }

    $request->validate([
        'titulo' => 'required|max:255',
        'resumen' => 'required',
        'descripcion' => 'required',
        'jornada' => 'required',
        'estado' => 'required|in:pendiente,aceptada,rechazada',
    ]);

    $propuesta->update([
        'titulo' => $request->titulo,
        'resumen' => $request->resumen,
        'descripcion' => $request->descripcion,
        'jornada' => $request->jornada,
        'estado' => $request->estado,
    ]);

    return redirect()
        ->route('propuestas.index')
        ->with('success', 'Propuesta actualizada correctamente.');
}

public function crearTaller(PropuestaTaller $propuesta)
{
    if (auth()->user()->email != 'cristian.rizzi@bue.edu.ar') {
        abort(403);
    }

    if ($propuesta->estado != 'aceptada') {
        return back()->with(
            'error',
            'Solo pueden crearse talleres a partir de propuestas aceptadas.'
        );
    }

    if ($propuesta->jornada == '17_tarde') {

        $existe = Taller::where('titulo', $propuesta->titulo)
            ->where('dia', '2026-06-17')
            ->exists();

        if (!$existe) {

            Taller::create([
                'titulo' => $propuesta->titulo,
                'descripcion' => $propuesta->descripcion,
                'dia' => '2026-06-17',
                'hora_inicio' => '14:00:00',
                'hora_fin' => '16:30:00',
                'aula' => 'A definir',
                'cupo' => 30,
                'inscriptos' => 0,
                'estado' => 'activo',
                'aprobado' => 1,
            ]);
        }
    }

    elseif ($propuesta->jornada == '18_manana') {

        $existe = Taller::where('titulo', $propuesta->titulo)
            ->where('dia', '2026-06-18')
            ->exists();

        if (!$existe) {

            Taller::create([
                'titulo' => $propuesta->titulo,
                'descripcion' => $propuesta->descripcion,
                'dia' => '2026-06-18',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '11:30:00',
                'aula' => 'A definir',
                'cupo' => 30,
                'inscriptos' => 0,
                'estado' => 'activo',
                'aprobado' => 1,
            ]);
        }
    }

    else {

        // 17
        $existe17 = Taller::where('titulo', $propuesta->titulo)
            ->where('dia', '2026-06-17')
            ->exists();

        if (!$existe17) {

            Taller::create([
                'titulo' => $propuesta->titulo,
                'descripcion' => $propuesta->descripcion,
                'dia' => '2026-06-17',
                'hora_inicio' => '14:00:00',
                'hora_fin' => '16:30:00',
                'aula' => 'A definir',
                'cupo' => 30,
                'inscriptos' => 0,
                'estado' => 'activo',
                'aprobado' => 1,
            ]);
        }

        // 18
        $existe18 = Taller::where('titulo', $propuesta->titulo)
            ->where('dia', '2026-06-18')
            ->exists();

        if (!$existe18) {

            Taller::create([
                'titulo' => $propuesta->titulo,
                'descripcion' => $propuesta->descripcion,
                'dia' => '2026-06-18',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '11:30:00',
                'aula' => 'A definir',
                'cupo' => 30,
                'inscriptos' => 0,
                'estado' => 'activo',
                'aprobado' => 1,
            ]);
        }
    }

    return back()->with(
        'success',
        'Taller creado correctamente.'
    );
}
}