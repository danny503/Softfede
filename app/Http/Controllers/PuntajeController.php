<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Puntaje;
use App\DetallePuntaje;

class PuntajeController extends Controller
{
    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $puntaje = new Putaje();
        $puntaje->idcategoria = $request->idcategoria;
        $torneo->nombre = $request->nombre;
        $torneo->fecha_inicio = $request->fecha_inicio;
        $torneo->fecha_fin = $request->fecha_fin;
        $torneo->estado = '1';
        $torneo->save();

        $inscripciones = $request->data;//Array de detalles
        //Recorro todos los elementos

        foreach($inscripciones as $ep=>$det)
        {
            $inscripcion = new DetalleTorneo();
            $inscripcion->idtorneo = $torneo->id;
            $inscripcion->idequipo = $det['idequipo'];
           // $inscripcion->fecha_ingreso = $det['fecha_ingreso'];         
            $inscripcion->save();
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }          
    }
}
