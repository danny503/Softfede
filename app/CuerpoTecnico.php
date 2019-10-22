<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuerpoTecnico extends Model
{
    protected $table = 'cuerpo_tecnico';
    protected $fillable = [
        'id' , 'idtipo'
    ];
    public $timestamps=false;
    public function tipo(){
        return $this->belongsTo('App\Tipo');
    }
    public function persona(){
        return $this->belongsTo('App\Persona');
    }
    
}
