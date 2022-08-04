<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = ["nb_ruta", "isActive"];

    
    public function rutas(){
        return $this->belongsTo(Ruta::class);
    }


}
