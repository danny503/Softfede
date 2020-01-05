<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProPartido;
use App\PuntajePartido;
use App\Jugador;
class PuntajePartidoController extends Controller
{
   
    public function index(Request $request)
    {
        
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $puntaje_partido = DB::table('puntaje_partido AS a')
             ->join('pro_partidos AS b','a.idpro_partido','=','b.id')
            ->join('equipos AS c','b.equipo_a','=','c.id')
            ->join('equipos AS d','b.equipo_b','=','d.id')
            ->select('a.punto_a, a.punto_b,a.ganador, c.nombre, d.nombre');
            //->orderBy('a.id', 'desc')->paginate(5);
           // return response()->json($puntaje_partido, 200);
            

        }
        else{
            $puntaje_partido = DB::table('puntaje_partido AS a')
             ->join('pro_partidos AS b','a.idpro_partido','=','b.id')
            ->join('equipos AS c','b.equipo_a','=','c.id')
            ->join('equipos AS d','b.equipo_b','=','d.id')
            ->select('a.punto_a,a.punto_b, a.ganador c.nombre, d.nombre')
            ->where('a.'.$criterio, 'like', '%'. $buscar . '%');
            //->orderBy('a.id', 'desc')->paginate(5);  

        }
        
       
    }
   
    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $puntaje_partido = new PuntajePartido();
        //$puntaje_partido->idpro_partido = $request->idpro_partido;
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
            $detalle->idpro_partido = $det['idpro_partido'];
            $detalle->idjugador = $det['idjugador'];
            $detalle->puntaje = $det['puntaje'];
            $detalle->falta = $det['falta'];        
            $detalle->save();
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }          
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
