<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTorneo extends Model
{
    protected $table = 'detalle_torneos';
    protected $fillable = [
        'idtorneo', 
        'idequipo'
    ];
    public $timestamps = false;
}
