<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable=['nombre','fechanac','genero','idrama','direccion','telefono','email'];

    public function user(){
        return $this->hasOne('App\User');
    }
    public function cuerpotecnico(){
        return $this->hasOne('App\CuerpoTecnico');
    }
}
