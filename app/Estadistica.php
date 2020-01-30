<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    protected $fillable = [ 'idtorneo','equipo_id', 'pj','pg','pp','pts'

    ];
    public function Programacion(){
        return $this->belongsTo('App\Programacion');
    }
    public function Equipo(){
        return $this->belongsTo('App\Equipo');
    }
}
