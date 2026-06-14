<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcreditacionController extends Controller
{
    // public function panel()
    // {
    //     return view('acreditaciones');
    // }

public function panel()
{
    if(auth()->user()->rol != 'admin'){
        return redirect('/');
    }

    $talleres = DB::table('talleres')
        ->orderBy('dia')
        ->orderBy('hora_inicio')
        ->get();

    return view('acreditaciones', compact('talleres'));
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

    return view('acreditarCongreso', compact('fecha'));
}

    public function guardarAcreditacionCongreso(Request $request, $fecha)
{
    $user = DB::table('users')
    ->where('DNI', preg_replace('/\D/', '', $request->dni))
    ->where('email', $request->email)
    ->first();

    if (!$user) {

        return back()->with(
            'error',
            'No encontramos una inscripción asociada a ese DNI y correo electrónico.'
        );
    }

    $yaExiste = DB::table('asistencias_congreso')
        ->where('user_id', $user->id)
        ->where('fecha_congreso', $fecha)
        ->exists();

    if (!$yaExiste) {

        DB::table('asistencias_congreso')->insert([
            'user_id' => $user->id,
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

public function verQrCongreso($dia)
{
    if (!in_array($dia, ['1', '2'])) {
        abort(404);
    }

    return view('qr.congreso', compact('dia'));
}

public function acreditarTaller($id)
{
    $taller = DB::table('talleres')
        ->where('id', $id)
        ->first();

    if (!$taller) {
        abort(404);
    }

    return view(
    'talleres.acreditar',
    compact('taller')
);
}

public function guardarAcreditacionTaller(
    Request $request,
    $id
)
{
    $user = DB::table('users')
        ->where(
            'DNI',
            preg_replace('/\D/', '', $request->dni)
        )
        ->where(
            'email',
            $request->email
        )
        ->first();

    if (!$user) {

        return back()->with(
            'error',
            'No encontramos una inscripción asociada a ese DNI y correo electrónico.'
        );
    }

    $inscripto = DB::table('inscripciones')
        ->where('user_id', $user->id)
        ->where('taller_id', $id)
        ->exists();

    if (!$inscripto) {

        return back()->with(
            'error',
            'No estás inscripto a este taller.'
        );
    }

    $yaExiste = DB::table('asistencias_talleres')
        ->where('user_id', $user->id)
        ->where('taller_id', $id)
        ->exists();

    if (!$yaExiste) {

        DB::table('asistencias_talleres')
            ->insert([

                'user_id' =>
                    $user->id,

                'taller_id' =>
                    $id,

                'fecha_hora_registro' =>
                    now(),

                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),

            ]);
    }

    return view(
        'acreditacionTallerExitosa',
        compact('yaExiste')
    );
}

public function verQrTaller($id)
{
    $taller = DB::table('talleres')
        ->where('id', $id)
        ->first();

    if (!$taller) {
        abort(404);
    }

    return view(
        'qr.taller',
        compact('taller')
    );
}
}