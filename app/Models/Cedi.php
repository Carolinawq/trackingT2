<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cedi extends Model
{
    use HasFactory;

    protected $fillable = ["nb_cedis", "nb_ubicacion","id_operacion", "isActive"];

    public function Cedis(){
        return $this->belongsTo(Cedi::class);
    }

    
}
