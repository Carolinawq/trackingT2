<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusUnidade extends Model
{
    use HasFactory;

    protected $fillable = ["nb_estatus", "isActive"];

    public function estatus_unidades(){
        return $this->belongsTo(EstatusUnidade::class);
    }

}
