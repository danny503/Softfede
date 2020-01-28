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
        ->select('b.nombre', DB::raw('SUM(a.pj) as pj'),
        DB::raw('SUM(a.pg) as pg'),
        DB::raw('SUM(a.pp) as pp'),
        DB::raw('SUM(a.pts) as pts'))
        //->where('a.equipo_id','=','b.id')
        ->groupBy('a.equipo_id')
        ->orderByRaw('Pts and Pg DESC')->get();
        return ['estadistica' => $estadisticas];
        /*select e.nombre, SUM( p.pj ) PJ, SUM( p.pg ) PG, SUM( p.pp ) PP, SUM( pts )PTS from
         estadisticas as p 
        inner join equipos as e on p.equipo_id = e.id 
        GROUP BY p.equipo_id
        ORDER BY Pts DESC;*/
        /*$estadistica = Estadistica::all();
        return $estadistica;*/
    }
    public function Buscar(Request $request, $id, $pa, $pb){
        if ($pa > $pb) {
            $rpga = 1;
            $rpgb = 0;
        }else{
            $rpga = 0;
            $rpgb = 1;
        }                   
                                
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                            
        $programaciones = $request->programaciones;

        foreach($programaciones as $item=>$pro){
            $programacion = new Programacion();
            $programacion->equipo_a = $pro['ideq1'];
            $programacion->equipo_b = $pro['ideq2'];
            $programacion->save();     
            $detalle_id = $request->detalle_id;         
            DB::estadistica("INSERT INTO estadisticas( equipo_id )
            SELECT equipo_a FROM programacions WHERE id = 2");
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
