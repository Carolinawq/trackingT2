<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEvento extends Model
{
    use HasFactory;

    protected $fillable = ["fecha_evento","id_unidad", "id_justificacion" , "ubicacion_inicial", "ubicacion_final","duracion_evento", "hora_inicial", "hora_final","descripcion" ];

}
