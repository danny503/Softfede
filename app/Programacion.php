<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $fillable = ['jornada','equipo_a','equipo_b','iddetalle_torneo'

];

    public function detalleTorneo(){
        return $this->belongsTo('App\DetalleTorneo');
    }
}
