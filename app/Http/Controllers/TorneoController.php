<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Torneo;
use App\DetalleTorneo;

class TorneoController extends Controller
{
    public function index(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $torneos = Torneo::join('categorias','torneos.idcategoria','=','categorias.id')
            ->select('torneos.id','torneos.idcategoria','torneos.nombre','torneos.fecha_inicio',
            'torneos.fecha_fin','torneos.estado','categorias.nombre as nombre_categoria')
            ->orderBy('torneos.id', 'desc')->paginate(5);
        }
        else{
            $torneos = Torneo::join('categorias','torneos.idcategoria','=','categorias.id')
            ->select('torneos.id','torneos.idcategoria','torneos.nombre',
            'torneos.fecha_inicio','torneos.fecha_fin','torneos.estado','categorias.nombre as nombre_categoria')
            ->where('torneos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('torneos.id', 'desc')->paginate(5);           
        }
        
        return [
            'pagination' => [
                'total'        => $torneos->total(),
                'current_page' => $torneos->currentPage(),
                'per_page'     => $torneos->perPage(),
                'last_page'    => $torneos->lastPage(),
                'from'         => $torneos->firstItem(),
                'to'           => $torneos->lastItem(),
            ],
            'torneos' => $torneos
        ];
    }

    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $torneo = new Torneo();
        $torneo->idcategoria = $request->idcategoria;
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

    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $torneo = Torneo::join('categorias','torneos.idcategoria','=','categorias.id')
        ->select('torneos.id','torneos.nombre','torneos.fecha_inicio',
        'torneos.fecha_fin','torneos.estado','categorias.nombre as categoria')
        ->where('torneos.id','=',$id)
        ->orderBy('torneos.id', 'desc')->take(1)->get();

         
        return [
           
            'torneo' => $torneo
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = DetalleTorneo::join('equipos','detalle_torneos.idequipo','=','equipos.id')
        ->join('ramas','equipos.idrama','=','ramas.id')
        ->join('categorias','equipos.idcategoria','=','categorias.id')        
        ->select('detalle_torneos.id','equipos.nombre as equipo','ramas.nombre as rama','categorias.nombre as nombre_categoria')
        ->where('detalle_torneos.idtorneo','=',$id)
        ->orderBy('detalle_torneos.id', 'desc')->get();         
        return [
           
            'detalles' => $detalles
        ];
    }

    public function pdf(Request $request,$id){
        $torneo = Torneo::join('categorias','torneos.idcategoria','=','categorias.id')
        ->join('equipos','torneos.id','=','equipos.id')
        ->join('ramas','equipos.idrama','=','ramas.id')
        ->select('torneos.id','torneos.nombre','torneos.fecha_inicio',
        'torneos.fecha_fin','ramas.nombre as rama','categorias.nombre as nombre_categoria')
        ->where('torneos.id','=',$id)
        ->orderBy('torneos.id','desc')->take(1)->get();

        $detalles = DetalleTorneo::join('equipos','detalle_torneos.idequipo','=','equipos.id')
        ->join('ramas','equipos.idrama','=','ramas.id')
        ->select('detalle_torneos.id','equipos.nombre as equipo','equipos.logo as logo','ramas.nombre as rama')
        ->where('detalle_torneos.idtorneo','=',$id)
        ->orderBy('detalle_torneos.id','desc')->get();

        $pdf = \PDF::loadView('pdf.torneo',['torneo'=>$torneo,'detalles'=>$detalles]);
        return $pdf->stream('torneo-'.'.pdf');

    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       // $detalle = DetalleTorneo::findOrFail($request->id);
       try{
        DB::beginTransaction();
        $torneo = Torneo::findOrFail($request->id);
        $torneo->nombre = $request->nombre;
        $torneo->idcategoria = $request->idcategoria;
        $torneo->fecha_inicio = $request->fecha_inicio;
        $torneo->fecha_fin = $request->fecha_fin;
        $torneo->estado = '1';

        $torneo->save();

        $inscripciones = $request->data;
        
        foreach($inscripciones as $ep=>$det)
        {
            //$inscripcion = new DetalleTorneo();
            $inscripcion = DetalleTorneo::findOrFail($request->id);
            $inscripcion->idtorneo = $request->id;
            $inscripcion->idequipo = $request->id;                    
            $inscripcion->save();
        }
        DB::commit();
 
    } catch (Exception $e){
        DB::rollBack();
    }
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $torneo = Torneo::findOrFail($request->id);
        $torneo->estado = '0';
        $torneo->save();
    }  
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $torneo = Torneo::findOrFail($request->id);
        $torneo->estado = '1';
        $torneo->save();
    }
    public function destroy(Request $request, $id){
        
    }
    public function selectTorneo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $torneo = Torneo:://
        select('id','nombre')
        ->where('estado','=','1')->get();
        return ['torneos' => $torneo];

    }   
    public function insertarEquipo(Request $request){
        //$idequipo = $request->idequipo;
        //$idtorneo = $request->idtorneo;
        /*DB::table('detalle_torneos')
       ->insert([
       'id' => $request->id,
       'idequipo' => $request->idequipo,
       'idtorneo' => $request->idequipo]
        );*/
        $inscripcion = new DetalleTorneo();
        $inscripcion->idtorneo =   $request->idtorneo;
        $inscripcion->idequipo = $request->idequipo;       
        $inscripcion->save();
       // INSERT INTO `detalle_torneos` (`id`, `idequipo`, `idtorneo`) VALUES ('25', '3', '3');

       }
        //DB::insert( 'INSERT INTO detalle_torneos (idequipo, idtorneo) VALUES ( $request.idequipo, $request.idtorneo)');
       
    }
    
