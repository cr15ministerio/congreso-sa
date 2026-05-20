<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropuestaTaller extends Model
{
    use HasFactory;

    protected $table = 'propuestas_talleres';

    protected $fillable = [
        'user_id',
        'titulo',
        'resumen',
        'descripcion',
        'jornada',
        'materiales',
        'solicita_computadoras',
        'estado',
    ];

    public function talleristas()
    {
        return $this->hasMany(PropuestaTallerista::class, 'propuesta_taller_id');
    }
}