<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taller;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TallerController extends Controller
{
    
public function index()
{
    $user = Auth::user();

    $misInscripciones = [];

    $inscripciones17 = false;
    $inscripciones18 = false;

    if ($user) {

        $misInscripciones = Inscripcion::where('user_id', $user->id)
            ->pluck('taller_id')
            ->toArray();

        // 👉 NUEVO
        $inscripciones17 = Inscripcion::where('user_id', $user->id)
            ->whereHas('taller', function ($q) {
                $q->where('dia', '2026-06-17');
            })
            ->exists();

        $inscripciones18 = Inscripcion::where('user_id', $user->id)
            ->whereHas('taller', function ($q) {
                $q->where('dia', '2026-06-18');
            })
            ->exists();
    }

    $talleres17 = Taller::where('dia', '2026-06-17')
        ->where('aprobado', 1)
        ->get();

    $talleres17Label = Carbon::parse('2026-06-17')
        ->locale('es')
        ->translatedFormat('l d \d\e F');

    $talleres18 = Taller::where('dia', '2026-06-18')
        ->where('aprobado', 1)
        ->get();

    $talleres18Label = Carbon::parse('2026-06-18')
        ->locale('es')
        ->translatedFormat('l d \d\e F');

    return view('talleres.index', compact(
        'talleres17',
        'talleres18',
        'talleres17Label',
        'talleres18Label',
        'misInscripciones',
        'inscripciones17',   // 👈 NUEVO
        'inscripciones18'    // 👈 NUEVO
    ));
}


}
