<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $fillable = ['idcategoria','nombre','fecha_inicio','fecha_fin','estado'
   ];

   public function categoria(){
      return $this->belongsTo('App\Categoria');
   }
}
