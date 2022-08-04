<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEstUnidChofRutUnid extends Model
{
    use HasFactory;

    protected $fillable = ["id_unidad", "id_estatus_unidades", "id_chofer", "id_ruta", "fecha_ruta", "no_vuelta"];

    public function detalle_est_unid_chof_rut_unid(){
        return $this->belongsTo(DetalleEstUnidChofRutUnid::class);
    }

}
