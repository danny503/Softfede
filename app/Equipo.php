<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
   // protected $table = 'equipos';
   //protected $primaryKey = 'id';
   protected $fillable = ['idrama','idusuario','nombre','logo'
   ];

   public function rama(){
      return $this->belongsTo('App\Rama');
   }
   public function user(){
      return $this->belongsTo('App\User');
   }
   public function jugadores(){
      return $this->belongsToMany(Jugador::class);
      }
        
}
