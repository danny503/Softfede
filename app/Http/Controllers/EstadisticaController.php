<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Estadistica;
use App\Programacion;
use App\Equipo;

class EstadisticaController extends Controller
{
    public function index(Request $request)
    {
        $estadisticas = DB::table('estadisticas as a')
        ->join('equipos as b','a.equipo_id','=','b.id')
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('b.nombre','b.logo', 'c.nombre as torneo', 'a.pj as pj','a.pg as pg','a.pp as pp','pts as pts')
        ->where('a.idtorneo','=', $request->idtorneo)
        ->groupBy('a.equipo_id')
        ->orderByRaw('Pts DESC')->get();
        return ['estadistica' => $estadisticas];
        /*select e.nombre, SUM( p.pj ) PJ, SUM( p.pg ) PG, SUM( p.pp ) PP, SUM( pts )PTS from
         estadisticas as p 
        inner join equipos as e on p.equipo_id = e.id 
        GROUP BY p.equipo_id
        ORDER BY Pts DESC;*/
        /*$estadistica = Estadistica::all();
        return $estadistica;*/
    }
    public function home(Request $request)
    {
        $estadisticas = DB::table('estadisticas as a')
        ->join('equipos as b','a.equipo_id','=','b.id')
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('b.nombre','b.logo', 'c.nombre as torneo', 'a.pj as pj','a.pg as pg','a.pp as pp','pts as pts')
        ->where('a.idtorneo','=', $request->idtorneo)
        ->groupBy('a.equipo_id')
        ->orderByRaw('Pts DESC')->get();
        return ['estadistica' => $estadisticas];
    }
}
