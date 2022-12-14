<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificacione extends Model
{
    use HasFactory;

    protected $fillable = ["nb_justificacion","id_evento","isActive"];

    public function justificaciones(){
        return $this->belongsTo(Justificacione::class);
    }
}



