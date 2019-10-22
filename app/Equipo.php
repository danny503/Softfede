<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
   // protected $table = 'equipos';
   //protected $primaryKey = 'id';
   protected $fillable = ['idrama','nombre','logo'
   ];

   public function rama(){
      return $this->belongsTo('App\Rama');
   }
        
}
