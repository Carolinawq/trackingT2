<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacione extends Model
{
    use HasFactory;

    protected $fillable = ["nb_operacion","isActive"];

    
    public function operaciones(){
        return $this->belongsTo(Operacione::class);
    }

}
