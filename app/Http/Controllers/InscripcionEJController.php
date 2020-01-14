<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Equipo;
use App\Jugador;
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

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $inscripcion = InscripcionJE::findOrFail($request->id);
        $inscripcion->numero_camisa = $request->numero_camisa;  
        $inscripcion->posicion = $request->posicion; 
        $inscripcion->save();
        /*DB::table('inscripcionej')
            ->where('id', 19)
            ->update(['numero_camisa' => 12]);*/               
    }

    public function destroy(Request $request, $id)
    {
        //$id = $request->id;
       // $inscripcion = new InscripcionJE();
        //$inscripcion = InscripcionJE::findOrFail($request->$id);
        //$inscripcion->delete();
        DB::table('inscripcionej')->where('id','=',$request->id)->delete();        
       //InscripcionJE::findOrFail($id)->delete();
      // $inscripcion->delete();
       // DB::table('inscripcionej')->where('id', $id)->delete();                      
    }
    public function borrar(Request $request)
    {
        $id = $request->id;       
        $detalles = InscripcionJE::destroy('inscripcionej')
       ->where('inscripcionej.id','=',$id);
       return [
           
        'detalles' => $detalles
    ];
               
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;         
        $detalles = InscripcionJE::join('personas','inscripcionej.idjugador','=','personas.id')
        ->select('inscripcionej.numero_camisa','inscripcionej.posicion','personas.nombre as persona')
        //->where('inscripcionej.idequipo','=',$id)
        ->orderBy('inscripcionej.id', 'desc')->get();                    
         
        return [
           
            'detalles' => $detalles
        ];
    }
    
}
