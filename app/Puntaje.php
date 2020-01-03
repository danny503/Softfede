<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    protected $fillable = ['equipo_a','equipo_b','ganador','idincripcionje','idpro_partido'
    
];

public function Incripcion(){
    return $this->belongsTo('App\InscripcionJE');
}
public function ProPartido(){
    return $this->belongsTo('App\ProPartido');
}

}
