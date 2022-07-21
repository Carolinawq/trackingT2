<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    use HasFactory;

    protected $fillable = ["nb_parada", "isActive"];

    
    public function paradas(){
        return $this->belongsTo(Parada::class);
    }
}
