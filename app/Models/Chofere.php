<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofere extends Model
{
    use HasFactory;

    protected $fillable = ["no_empleado","nb_chofer","nb_chofer_a_paterno","nb_chofer_a_materno","id_cedis", "isActive"];

    public function choferes(){
        return $this->belongsTo(Chofere::class);
    }

}
