<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    protected $table = 'arbitros';
    protected $fillable = [
        'id' , 'cargo'
    ];
    public $timestamps=false;

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
}
