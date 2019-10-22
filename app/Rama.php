<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rama extends Model
{
    protected $fillable = ['nombre'];

    public function equipos()
    {
        return $this->hasMany('App\Equipo');
    }
}
