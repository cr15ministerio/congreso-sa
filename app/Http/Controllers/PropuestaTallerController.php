<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropuestaTaller;
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
}