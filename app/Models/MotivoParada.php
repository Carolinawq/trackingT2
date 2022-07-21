<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoParada extends Model
{
    use HasFactory;

    protected $fillable = ["nb_motivo_parada","id_parada","isActive"];

    public function motivo_paradas(){
        return $this->belongsTo(MotivoParada::class);
    }
}
