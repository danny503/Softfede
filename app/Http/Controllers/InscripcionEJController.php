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
        $existe= DB::table('inscripcionej')
        ->select('*')
        ->where([['idequipo','=', $request->idequipo],['numero_camisa','=', $request->numero_camisa]])->count();
        
        if($existe == 0 ){
            $inscripcion = new InscripcionJE();
            $inscripcion->idequipo =  $request->idequipo;
            $inscripcion->idjugador = $request->idjugador;
           //$inscripcion->fecha_ingreso = $det['fecha_ingreso'];
            $inscripcion->numero_camisa = $request->numero_camisa;  
            $inscripcion->posicion = $request->posicion;          
            $inscripcion->save();
        }else{
            
           $existe = 1;
        }
        return $existe;            
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
        //if(!$request->ajax()) return redirect('/');
        
         DB::table('inscripcionej')->where('detalle_id','=', $request->detalle_id)
        ->update(['numero_camisa'=> $request->numero_camisa,'posicion' =>$request->posicion]);
        /*UPDATE `inscripcionej` SET `numero_camisa` = '5', `posicion` = 'Basa'
         WHERE `inscripcionej`.`id` = 1;*/
    }

    public function destroy(Request $request, $id)
    {
        //$id = $request->id;
       // $inscripcion = new InscripcionJE();
        //$inscripcion = InscripcionJE::findOrFail($request->$id);
        //$inscripcion->delete();
        DB::table('inscripcionej')->where('detalle_id','=',$request->detalle_id)->delete();        
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
