<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
    'user_id',
    'escuela',
    'rol_en_escuela',
];
}
