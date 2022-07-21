<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cedi extends Model
{
    use HasFactory;

    protected $fillable = ["nb_cedis", "pp", "pv", "isActive"];

    
    public function cedis(){
        return $this->belongsTo(Cedi::class);
    }



    
}
