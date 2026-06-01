<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends Controller
{
    public function create()
    {
        return view('perfil.create');
    }

    public function store(Request $request)
    {
        Participante::create([
            'user_id' => Auth::id(),
            'escuela' => $request->escuela,
            'rol_en_escuela' => $request->rol_en_escuela,
        ]);

        return redirect('/dashboard');
    }

    public function index()
{
    if (Auth::user()->rol !== 'admin') {

        abort(403);

    }
    $participantes = DB::table('users')
        ->leftJoin('participantes', 'users.id', '=', 'participantes.user_id')
        ->select(
            'users.id',
            'users.nombre',
            'users.apellido',
            'users.DNI',
            'users.email',
            'users.rol',
            'participantes.escuela',
            'participantes.rol_en_escuela'
        )
        ->orderBy('users.apellido')
        ->orderBy('users.nombre')
        ->get();

    return view('participantes.index', compact('participantes'));
}
}