<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EstudianteController extends Controller
{
    public function formulario()
    {
        return view('cargarEstudiantes');
    }

   public function guardar(Request $request)
{
    $request->validate([

        'area' => 'required',

        'escuela' => 'required',

        'estudiantes' => 'required|array|min:1',

        'estudiantes.*.nombre' => 'required',

        'estudiantes.*.apellido' => 'required',

        'estudiantes.*.dni' => 'required',

        'estudiantes.*.nivel' => 'required',

    ]);

    foreach ($request->estudiantes as $estudiante) {

        $dniLimpio =
            preg_replace('/\D/', '', $estudiante['dni']);

        $emailFicticio =
            'estudiante_' .
            Str::uuid() .
            '@no-login.local';

        $passwordAleatoria =
            Str::random(40);

        User::create([

            'name' =>
                $estudiante['nombre'] .
                ' ' .
                $estudiante['apellido'],

            'nombre' =>
                $estudiante['nombre'],

            'apellido' =>
                $estudiante['apellido'],

            'DNI' =>
                $dniLimpio,

            'email' =>
                $emailFicticio,

            'password' =>
                Hash::make($passwordAleatoria),

            'rol' =>
                'estudiante',

            'nivel' =>
                $estudiante['nivel'],

            'area' =>
                $request->area,

            'escuela' =>
                $request->escuela,

        ]);

    }

    return back()->with(
        'success',
        'Estudiantes cargados correctamente'
    );
}

    public function buscarEscuelas(Request $request)
{
    $area = $request->area;
    $q = strtolower($request->q);

    $csvPath =
        storage_path('app/public/escuelas-congreso-sa.csv');

    $resultados = [];

    if (($handle = fopen($csvPath, 'r')) !== false) {

        $headers = fgetcsv($handle, 1000, ',');

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {

            $fila = array_combine($headers, $row);

            if (
                trim($fila['area_esc']) === trim($area)
                &&
                str_contains(
                    strtolower($fila['nombre_esc']),
                    $q
                )
            ) {

                $resultados[] =
                    $fila['nombre_esc'];

            }

        }

        fclose($handle);
    }

    return response()->json($resultados);
}
}