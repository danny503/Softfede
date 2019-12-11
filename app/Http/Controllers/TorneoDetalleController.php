<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Torneo;
use App\DetalleTorneo;

class TorneoDetalleController extends Controller
{
    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();        
            $inscripcion = new DetalleTorneo();
            $inscripcion->idtorneo = $torneo->id;
            $inscripcion->idequipo = $det['idequipo'];
           // $inscripcion->fecha_ingreso = $det['fecha_ingreso'];         
            $inscripcion->save();
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }          
    }
}
