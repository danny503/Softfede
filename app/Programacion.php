<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $fillable = ['jornada','equipo_a','equipo_b','idtorneo','fecha','hora','idsede','puntaje_a','puntaje_b'

];

    public function detalleTorneo(){
        return $this->belongsTo('App\DetalleTorneo');
    }
    public function Sede(){
        return $this->belongsTo('App\Sede');
    }
}
