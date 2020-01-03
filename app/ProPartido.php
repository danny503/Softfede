<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProPartido extends Model
{
    protected $fillable = ['hora','fecha','num_partido','idsede','iddetalle_torneo'

    ];

    public function sede(){
        return $this->belongsTo('App\Sede');
    }
    public function detalleTorneo(){
        return $this->belongsTo('App\DetalleTorneo');
    }

}
