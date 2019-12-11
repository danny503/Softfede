<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProPartido extends Model
{
    protected $table = 'propartidos';
    protected $fillable = [
        'id' , 'hora', 'fecha', 'equipo_a', 'equipo_b', 'idsede'
    ];
    public $timestamps=false;

    public function sede(){
        return $this->belongsTo('App\Sede');
    }
}
