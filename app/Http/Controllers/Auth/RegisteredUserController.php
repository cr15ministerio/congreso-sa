<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([

        'nombre' => [
            'required',
            'string',
            'max:100'
        ],

        'apellido' => [
            'required',
            'string',
            'max:100'
        ],

        'DNI' => [
            'required',
            'string',
            'max:20'
        ],

        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:' . User::class
        ],

        'password' => [
            'required',
            'confirmed',
            'min:6'
        ],

        'rol' => [
            'required'
        ],

    ]);

    // agregado para validar que se completen todos los campos
    // VALIDACIONES CONDICIONALES DEL FORMULARIO

$rolesConInstitucion = [
    'participante',
    'expositor',
    'tallerista',
];

if (in_array($request->rol, $rolesConInstitucion)) {

    if (!$request->tipo_institucion) {

        throw ValidationException::withMessages([
            'tipo_institucion' =>
                'Debe seleccionar el tipo de institución.',
        ]);

    }

    if ($request->tipo_institucion === 'Escuela') {

        if (!$request->area) {

            throw ValidationException::withMessages([
                'area' =>
                    'Debe seleccionar un área.',
            ]);

        }

        if (!$request->escuela) {

            throw ValidationException::withMessages([
                'escuela' =>
                    'Debe seleccionar una escuela.',
            ]);

        }

    }

    if ($request->tipo_institucion === 'Universidad') {

        if (!$request->universidad) {

            throw ValidationException::withMessages([
                'universidad' =>
                    'Debe seleccionar una universidad.',
            ]);

        }

        if (
            $request->universidad === 'Otra universidad'
            &&
            !$request->organizacion
        ) {

            throw ValidationException::withMessages([
                'organizacion' =>
                    'Debe indicar el nombre de la universidad.',
            ]);

        }

    }

    if (!$request->rol_en_escuela) {

        throw ValidationException::withMessages([
            'rol_en_escuela' =>
                'Debe indicar su rol en la institución.',
        ]);

    }

}

if (
    $request->rol === 'invitado'
    &&
    !$request->organizacion_invitado
) {

    throw ValidationException::withMessages([
        'organizacion_invitado' =>
            'Debe indicar la organización.',
    ]);

}
    // fin de agregado

      // agregado para validar tallerista
          // VALIDAR TALLERISTA

    if ($request->rol === 'tallerista') {

        $registroTallerista =
            DB::table('propuestas_talleristas')
                ->where('email', $request->email)
                ->first();

        // NO EXISTE PROPUESTA

        if (!$registroTallerista) {

            throw ValidationException::withMessages([

                'email' =>
                    'No encontramos una propuesta de taller asociada a este mail.',

            ]);

        }

        // BUSCAR PROPUESTA

        $propuesta =
            DB::table('propuestas_talleres')
                ->where('id', $registroTallerista->propuesta_taller_id)
                ->first();

        // PENDIENTE

        if ($propuesta && $propuesta->estado === 'pendiente') {

            throw ValidationException::withMessages([

                'email' =>
                    'Tu propuesta de taller todavía está en evaluación.',

            ]);

        }

        // RECHAZADA

        if ($propuesta && $propuesta->estado === 'rechazada') {

            throw ValidationException::withMessages([

                'email' =>
                    'Tu propuesta no fue aprobada. Podés registrarte como participante.',

            ]);

        }

    }
    
    // fin de agregado

    // NORMALIZAR DNI

    $dniLimpio =
        preg_replace('/\D/', '', $request->DNI);

    // CREAR USER

    $user = User::create([

        'name' =>
            $request->nombre . ' ' . $request->apellido,

        'nombre' =>
            $request->nombre,

        'apellido' =>
            $request->apellido,

        'DNI' =>
            $dniLimpio,

        'email' =>
            $request->email,

        'password' =>
            Hash::make($request->password),

        'rol' =>
            $request->rol,

    ]);

    // DETERMINAR ESCUELA / ORGANIZACIÓN

    $escuela = null;

    // SI ELIGIÓ ESCUELA

    if ($request->tipo_institucion === 'Escuela') {

        $escuela = $request->escuela;

    }

    // SI ELIGIÓ OTRA UNIVERSIDAD

    if (
        $request->tipo_institucion === 'Universidad'
        &&
        $request->universidad === 'Otra universidad'
    ) {

        $escuela = $request->organizacion;

    }

    // SI ELIGIÓ UNIVERSIDAD DE LA CIUDAD

    if (
        $request->tipo_institucion === 'Universidad'
        &&
        $request->universidad === 'Universidad de la Ciudad'
    ) {

        $escuela = 'Universidad de la Ciudad';

    }

    // SI ES INVITADO

    if ($request->rol === 'invitado') {

        $escuela =
            $request->organizacion_invitado;

    }

    // SI ES EQUIPO ORGANIZADOR

    if ($request->rol === 'equipo_organizador') {

        $escuela =
            'Ministerio de Educación GCBA';

    }

    // CREAR PARTICIPANTE

    DB::table('participantes')->insert([

        'user_id' =>
            $user->id,

        'escuela' =>
            $escuela,

        'rol_en_escuela' =>
            $request->rol_en_escuela,

        'created_at' =>
            now(),

        'updated_at' =>
            now(),

    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(
        route('dashboard', absolute: false)
    );
}
}
