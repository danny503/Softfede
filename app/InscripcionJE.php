<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionJE extends Model
{
    protected $table = 'inscripcionej';
    protected $fillable = [
        'idjugador', 
        'idequipo',
        'fecha_ingreso',
        'numero_camisa',
        'posicion'
    ];
    public $timestamps = false;
    
   public function jugadores(){
    return $this->belongsToMany('App\Jugador');
    }
    public function equipos(){
        return $this->belongsToMany('App\Equipo');
    }
    public function borrar(Request $request)
    {
        $id = $request->id;
       
       // DELETE FROM `inscripcionej` WHERE `inscripcionej`.`id` = 5;
               
    }
}
