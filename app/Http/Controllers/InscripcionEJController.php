<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Equipo;
use App\InscripcionJE;
class InscripcionEJController extends Controller
{
  
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $inscripcion = new InscripcionJE();
        $inscripcion->idequipo =  $request->idequipo;
       $inscripcion->idjugador = $request->idjugador;
       //$inscripcion->fecha_ingreso = $det['fecha_ingreso'];
        $inscripcion->numero_camisa = $request->numero_camisa;  
        $inscripcion->posicion = $request->posicion;          
        $inscripcion->save();
      
       
    }

    
    public function show($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $inscripcion = InscripcionJE::find($id);
        $inscripcion->delete();
        //Session::flash('message','Usuario eliminado correctamente');
    }
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $inscripcion = InscripcionJE::findOrFail($request->id);
        $inscripcion->idequipo =  $request->idequipo;
       $inscripcion->idjugador = $request->idjugador;
       //$inscripcion->fecha_ingreso = $det['fecha_ingreso'];
        $inscripcion->numero_camisa = $request->numero_camisa;  
        $inscripcion->posicion = $request->posicion;          
        $inscripcion->save();
    }
}
