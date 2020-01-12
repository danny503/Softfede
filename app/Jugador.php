<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    protected $fillable = [
        'id' , 'estatura', 'foto','idusuario'
    ];
    public $timestamps=false;

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function equipos(){
        return $this->belongsToMany(Equipo::class);
    }
}
