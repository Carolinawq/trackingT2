<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleParada extends Model
{
    use HasFactory;

    protected $fillable = ["fecha_parada", "id_unidad","id_motivo_parada","ubicacion"];

}
