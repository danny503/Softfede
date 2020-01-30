<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Torneo;
use App\Equipo;
use App\DetalleTorneo;
use DB;

class TorneoDetalleController extends Controller
{
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();   
        $inscripciones = $request->data;//Array de detalles
        //Recorro todos los elementos
        foreach($inscripciones as $ep=>$det)
        {
            $inscripcion = new DetalleTorneo();
            $inscripcion->idequipo = $det['idequipo'];
            $inscripcion->idtorneo = $request->idtorneo;
            $inscripcion->save();
        }
       /* $idequipo = $request->idequipo;
        $idtorneo = $request->idtorneo;
        DB::table('detalle_torneos')->insert([array('idequipo'=>$idequipo), 'idtorneo'=>$idtorneo]);*/
        /*$inscripcion = new DetalleTorneo();
        $inscripcion->idtorneo = $request->idtorneo;
        $inscripcion->save();

        $inscripciones = $request->data;//Array de detalles
        //Recorro todos los elementos
        foreach($inscripciones as $ep=>$det)
        {
            $inscripcion1 = new DetalleTorneo();
            $inscripcion1->idequipo = $det['idequipo'];
            //$inscripcion->idtorneo = $inscripcion->id;
            //$inscripcion1->idtorneo = $request->idtorneo;
            $inscripcion1->save();
        }*/
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }
    }
}
