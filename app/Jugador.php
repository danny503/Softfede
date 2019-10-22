<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    protected $fillable = [
        'id' , 'estatura', 'foto'
    ];
    public $timestamps=false;

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
}
