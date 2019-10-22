<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{
    public function index(Request $request)
    {
    if(!$request->ajax()) return redirect('/');
    $roles = Rol::all();
    return $roles;
    }
    
    public function selectRol(Request $request){
        
        $roles = Rol::
        select('id','nombre')->orderBy('nombre','asc')->get();
        return ['roles' => $roles];

    }
}
