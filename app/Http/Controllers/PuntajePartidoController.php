<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Programacion;
use App\PuntajePartido;
use App\Jugador;
use App\Equipo;
use App\DetallePartido;
//use DB;

class PuntajePartidoController extends Controller
{
   
    public function index(Request $request)
    {
        
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $puntaje_partido = DB::table('puntaje_partidos AS a')
            ->join('programacions AS b','a.idpro_partido','=','b.id')
            ->join('equipos AS c','b.equipo_a','=','c.id')
            ->join('equipos AS d','b.equipo_b','=','d.id')
            ->select('a.punto_a', 'a.punto_b','a.ganador', 'c.nombre', 'd.nombre')
            ->orderBy('a.id', 'desc');        
        }
        else{
            $puntaje_partido = DB::table('puntaje_partidos AS a')
             ->join('pro_partidos AS b','a.idpro_partido','=','b.id')
            ->join('equipos AS c','b.equipo_a','=','c.id')
            ->join('equipos AS d','b.equipo_b','=','d.id')
            ->select('a.punto_a','a.punto_b', 'a.ganador',' c.nombre', 'd.nombre')
            //->where('a.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('a.id', 'desc'); 

        }
      /*  $puntaje_partido = PuntajePartido::all();
        return $puntaje_partido;*/
      //  return response()->json($puntaje_partido, 200);               
    }
   
    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $puntaje_partido = new PuntajePartido();
        $puntaje_partido->idpro_partido = $request->idpro_partido;
        $puntaje_partido->punto_a = $request->punto_a;
        $puntaje_partido->punto_b = $request->punto_b;
        $puntaje_partido->ganador = $request->ganador;
       
        $puntaje_partido->save();

        $detalle_puntaje = $request->data;//Array de detalles
        //Recorro todos los elementos

        foreach($detalle_puntaje as $ep=>$det)
        {
            $detalle = new DetallePartido();
            $detalle->idpuntaje_partido = $puntaje_partido->id;
            $detalle->puntaje = $det['puntaje'];
            $detalle->falta = $det['falta'];  
            //$detalle->idpro_partido = $det['idpro_partido'];
            $detalle->idjugador = $det['idpersona'];                  
            $detalle->save();
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }          
    }
    public function TopJugdorPdf(Request $request,$id){
        $puntaje_partido = PuntajePartido::select('puntaje_partidos.id','puntaje_partidos.ganador')
        ->where('puntaje_partidos.id','=',$id)
        ->orderBy('puntaje_partidos.id','desc')->take(1)->get();    
    
        $detalles = DB::table('detalle_partidos as a')
        ->join('personas as b','a.idjugador','=','b.id')
        ->join('jugadores as c','a.idjugador','=','c.id')
        ->select('a.idjugador','c.foto','b.nombre',DB::raw('SUM(a.puntaje) as puntaje'))
       // ->where('a.id','=',$id)
        ->groupBy('a.idjugador','c.foto')
        ->orderBy(DB::raw('MAX(a.puntaje)'), 'desc')
        ->limit(5)
        ->get();

        $pdf = \PDF::loadView('pdf.top_jugador',['puntaje'=>$puntaje_partido,'detalles'=>$detalles]);
        return $pdf->stream('puntaje_partidos.pdf');

        /*SELECT a.idjugador,b.nombre, SUM(a.puntaje) FROM detalle_partidos as a INNER JOIN personas 
        as b on a.idjugador = b.id  group by a.idjugador ORDER BY MAX(a.puntaje) DESC LIMIT 0,3*/
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }
}
