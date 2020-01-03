<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function authorizeRoles($roles){
        if($this->hasAnyRole($roles)){
            return true;
        }
        abort(401, 'This action is unauthorized');
    }
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }

        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
    public function hasRole($role){
        if($this->roles()->where('nombre',$role)->first()){
            return true;
        }
        return false;
    }
     

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  
    
    protected $fillable = [
        'id', 'login', 'password', 'estado' , 'idrol'
    ];
    public $timestamps=false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function rol(){
        return $this->belongsTo('App\Rol');
    }
    public function persona(){
        return $this->belongsTo('App\Persona');
    }
    
}
