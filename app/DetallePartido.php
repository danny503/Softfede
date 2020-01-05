<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePartido extends Model
{
    protected $fillable = [ 'puntaje','falta','idpuntaje_partido','idpro_partido','idjugador'

    ];
    public function PuntajePartido(){
        return $this->belognsTo('App\PuntajePartido');
    }
    public function ProPartido(){
        return $this->belognsTo('App\ProPartido');
    }
    public function Jugador(){
        return $this->belognsTo('App\Jugador');
   }
}
  
