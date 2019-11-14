<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Equipo;

class IndexController extends Controller
{
    //
    
    public function __construct(){
        $this->middleware('auth',['only' => 'administrador ']); //aca especificamsos la ruta del admin, si dejamos solo   $this->middleware('auth'); se aplicara a todo
      }

      public function index()
    {
      return view('index'); //RETORNAMOS LA VISTA INDEX - HACEMOS REFERENCIA AL HTML que sera en BLADE
    }

    public function administrador(){  //AGREGAMOS PARA EL ADMINISTRADOR EN EL CONTROLADOR UN MÉTODO
        return view('welcome'); //le decimos que busque en vistas (VIEWS) en la carpeta ADMIN y coja el archivo index
       }
}
