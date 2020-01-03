<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntajeJugador extends Model
{
    public $fillable = ['puntaje','falta','idpro_partido','idjugador'
    
];
    public function ProPartido(){
        return $this->belognsTo('App\ProPartido');
    }
    public function Jugador(){
        return $this->belognsTo('App\Jugador');
    }
}
