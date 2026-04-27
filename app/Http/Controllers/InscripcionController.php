<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Taller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InscripcionController extends Controller
{


public function store($id)
{
    $user = Auth::user();
    $taller = Taller::findOrFail($id);

    // 1. Verificar cupo
  $anchor = ($taller->dia == '2026-06-17') ? 'dia17' : 'dia18';

if ($taller->inscriptos >= $taller->cupo) {
    return redirect('/talleres#' . $anchor)
        ->with('error', 'No hay cupo disponible');
}

    // 2. Buscar si ya está inscripto en un taller de la misma franja
    $inscripcionExistente = Inscripcion::where('user_id', $user->id)
        ->whereHas('taller', function ($q) use ($taller) {
            $q->where('dia', $taller->dia)
              ->where('hora_inicio', $taller->hora_inicio);
        })
        ->first();

    // 3. Si existe → liberar cupo anterior
    if ($inscripcionExistente) {
        $tallerAnterior = Taller::find($inscripcionExistente->taller_id);
        $tallerAnterior->decrement('inscriptos');

        $inscripcionExistente->delete();
    }

    // 4. Crear nueva inscripción
    Inscripcion::create([
        'user_id' => $user->id,
        'taller_id' => $taller->id,
    ]);

    // 5. Incrementar cupo
    $taller->increment('inscriptos');

    $anchor = ($taller->dia == '2026-06-17') ? 'dia17' : 'dia18';

return redirect('/talleres#' . $anchor)
    ->with('success', 'Inscripción realizada correctamente');
}

public function formPublico()
{
    return view('inscripciones.buscar');
}

public function buscarPublico(Request $request)
{
    $user = User::where('DNI', $request->dni)->first();

    if (!$user) {
        return back()->with('error', 'No se encontró usuario');
    }

    $inscripciones = Inscripcion::where('user_id', $user->id)
        ->with('taller')
        ->get();

    return view('inscripciones.resultado', compact('user', 'inscripciones'));
}

}
