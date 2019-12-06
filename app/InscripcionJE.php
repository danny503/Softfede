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
}
