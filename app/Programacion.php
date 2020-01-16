<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $fillable = ['id','jornada','equipo_a','equipo_b','idtorneo'

];

    public function detalleTorneo(){
        return $this->belongsTo('App\DetalleTorneo');
    }
}
