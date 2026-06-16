<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

public function certificados()
{
    return view('certificados.buscar');
}

public function buscarCertificados(Request $request)
{
    $dni = preg_replace('/\D/', '', $request->dni);

if (!empty($request->email)) {

    $user = DB::table('users')
        ->where('DNI', $dni)
        ->where('email', $request->email)
        ->first();

} else {

    $user = DB::table('users')
        ->where('DNI', $dni)
        ->where('rol', 'estudiante')
        ->first();

}

    if (!$user) {

        return back()->with(
            'error',
            'No fue posible emitir el certificado con esos datos. Si NO es estudiante, además de su DNI debe ingresar el correo electrónico con el cual se registró.'
        );
    }

    $certificadosCongreso =
        DB::table('asistencias_congreso')
            ->where('user_id', $user->id)
            ->orderBy('fecha_congreso')
            ->get();

    $certificadosTalleres =
        DB::table('asistencias_talleres')
            ->join(
                'talleres',
                'asistencias_talleres.taller_id',
                '=',
                'talleres.id'
            )
            ->where(
                'asistencias_talleres.user_id',
                $user->id
            )
            ->select(
                'talleres.id',
                'talleres.titulo',
                'talleres.dia',
                'talleres.hora_inicio',
                'talleres.hora_fin'
            )
            ->get();

    return view(
        'certificados.listado',
        compact(
            'user',
            'certificadosCongreso',
            'certificadosTalleres'
        )
    );
}

public function certificadoCongreso($user, $fecha)
{
    $usuario = DB::table('users')
        ->where('id', $user)
        ->first();

    if (!$usuario) {
        abort(404);
    }

    $evento = DB::table('asistencias_congreso')
        ->where('user_id', $user)
        ->where('fecha_congreso', $fecha)
        ->first();

    if (!$evento) {
        abort(404);
    }

if ($usuario->rol == 'tallerista') {

    $detalle = '';

    $archivo = storage_path(
        'app/lista_certificados_especiales.csv'
    );

    if (file_exists($archivo)) {

        $handle = fopen($archivo, 'r');

        // Saltar encabezado
        fgetcsv($handle);

        while (($fila = fgetcsv($handle, 0, ',')) !== false) {

    if (
        trim($fila[0]) == trim($usuario->DNI) &&
        strtolower(trim($fila[1])) == strtolower(trim($usuario->email)) &&
        trim($fila[2]) == trim($fecha) &&
        trim($fila[3]) == 'tallerista'
    ) {
        $detalle = trim($fila[4]);
        break;
    }
}

        fclose($handle);
    }

    if ($detalle == '') {
    abort(404);
}

    $pdf = Pdf::loadView(
        'certificados.congresoTallerista',
        compact(
            'usuario',
            'evento',
            'detalle'
        )
    );

    return $pdf->download(
        'certificado-congreso-'.$usuario->DNI.'.pdf'
    );
}

$pdf = Pdf::loadView(
    'certificados.congreso',
    compact(
        'usuario',
        'evento'
    )
);

return $pdf->download(
    'certificado-congreso-'.$usuario->DNI.'.pdf'
);

}

public function certificadoTaller($user, $taller)
{
    $usuario = DB::table('users')
        ->where('id', $user)
        ->first();

    if (!$usuario) {
        abort(404);
    }

    $asistencia = DB::table('asistencias_talleres')
        ->where('user_id', $user)
        ->where('taller_id', $taller)
        ->first();

    if (!$asistencia) {
        abort(404);
    }

    $taller = DB::table('talleres')
        ->where('id', $taller)
        ->first();

    if (!$taller) {
        abort(404);
    }

    $pdf = Pdf::loadView(
        'certificados.congresoAsistenciaTaller',
        compact(
            'usuario',
            'taller'
        )
    );

    return $pdf->download(
        'certificado-taller-' .
        $usuario->DNI .
        '-' .
        $taller->id .
        '.pdf'
    );
}

}