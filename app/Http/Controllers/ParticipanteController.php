<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use Illuminate\Support\Facades\Auth;

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
}