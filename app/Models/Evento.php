<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ["nb_evento", "isActive"];

    
    public function eventos(){
        return $this->belongsTo(Evento::class);
    }
}
