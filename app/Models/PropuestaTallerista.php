<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropuestaTallerista extends Model
{
    use HasFactory;

    protected $table = 'propuestas_talleristas';

    protected $fillable = [
        'propuesta_taller_id',
        'nombre',
        'apellido',
        'email',
        'tipo',
    ];

    public function propuesta()
    {
        return $this->belongsTo(PropuestaTaller::class, 'propuesta_taller_id');
    }
}