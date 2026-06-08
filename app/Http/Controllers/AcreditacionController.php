<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcreditacionController extends Controller
{
    public function panel()
    {
        return view('acreditaciones');
    }

    public function acreditarCongreso($fecha)
    {
        $fechasValidas = [

        '2026-06-17',

        '2026-06-18'

    ];

    if (!in_array($fecha, $fechasValidas)) {

        abort(404);

    }
        $yaExiste = DB::table('asistencias_congreso')
            ->where('user_id', Auth::id())
            ->where('fecha_congreso', $fecha)
            ->exists();

        if (!$yaExiste) {

            DB::table('asistencias_congreso')->insert([
                'user_id' => Auth::id(),
                'fecha_congreso' => $fecha,
                'fecha_hora_registro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('acreditacionExitosa', [
            'fecha' => $fecha,
            'yaExistia' => $yaExiste
        ]);
    }
}