<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProPartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $propartidos = ProPartido::join('sedes','propartidos.idsede','=','sedes.id')
            ->select('propartidos.id','propartidos.idsede','propartidos.nombre','sedes.nombre as nombre_sede')
            ->orderBy('propartidos.id', 'desc')->paginate(4);
        }
        else{
            $propartidos = Equipo::join('sedes','propartidos.idsede','=','sedes.id')
            ->select('propartidos.id','propartidos.idsede','propartidos.nombre','sedes.nombre as nombre_sede')
            ->where('propartidos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('propartidos.id', 'desc')->paginate(4);
        }

        return [
            'pagination' => [
                'total'        => $propartidos->total(),
                'current_page' => $propartidos->currentPage(),
                'per_page'     => $propartidos->perPage(),
                'last_page'    => $propartidos->lastPage(),
                'from'         => $propartidos->firstItem(),
                'to'           => $propartidos->lastItem(),
            ],
            'propartidos' => $propartidos
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if (!$request->ajax()) return redirect('/');
        $propartidos = new ProPartido();
        $propartidos->idsede = $request->idsede;
        $propartidos->hora = $request->hora;
        $propartidos->fecha = $request->fecha;
        $propartidos->equipo_a = $request->equipo_a;
        $propartidos->equipo_b = $request->equipo_b;
        $propartidos->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $propartidos = ProPartido::findOrFail($request->id);
        $propartidos->idsede = $request->idsede;
        $propartidos->hora = $request->hora;
        $propartidos->fecha = $request->fecha;
        $propartidos->equipo_a = $request->equipo_a;
        $propartidos->equipo_b = $request->equipo_b;
        $propartidos->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
