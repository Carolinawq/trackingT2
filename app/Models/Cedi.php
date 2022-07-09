<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cedi extends Model
{
    use HasFactory;

    protected $fillable = ["nb_cedis", "nb_ubicacion"];

    /*public function Operacione(){
        return $this->belongsTo(Operacione::class);
    }*/

    
}
