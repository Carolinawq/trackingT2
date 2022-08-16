<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Velocidade extends Model
{
    use HasFactory;

    protected $fillable = ['nb_unidad','ubicacion_inicio', 'ubicacion_fin', 'duracion','velocidad','fecha'];

}
