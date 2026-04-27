<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'talleres';
    
    protected $fillable = [
    'titulo',
    'descripcion',
    'dia',
    'hora_inicio',
    'hora_fin',
    'aula',
    'cupo',
    'inscriptos',
    'estado',
    'aprobado',
    'user_id',
];
}
