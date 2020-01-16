<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Programacion;

class ProgramacionController extends Controller
{
    public function selectPro(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $proPartido = Programacion:://where('condicion','=','1')
        select('id')->get();
        return ['programacions' => $proPartido];

    }

}
