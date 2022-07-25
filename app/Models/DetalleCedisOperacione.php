<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCedisOperacione extends Model
{
    use HasFactory;

    protected $fillable = ["id_cedis", "id_operacion"];

    public function detalle_cedis_operaciones(){
        return $this->belongsTo(DetalleCedisOperacione::class);
    }

}
