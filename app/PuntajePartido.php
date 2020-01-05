<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntajePartido extends Model
{
    public $fillable = ['punto_a','punto_b','ganador'
    
];
   /* public function ProPartido(){
        return $this->belognsTo('App\ProPartido');
    }*/
    public $timestamps = false;
}
