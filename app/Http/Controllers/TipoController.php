<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipos = Tipo::all();
        return $tipos;
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
        $tipo = new Tipo();
        $tipo->nombre = $request->nombre;
        $tipo->condicion ='1';
        $tipo->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipo = Tipo::findOrFail($request->id); 
        $tipo->nombre = $request->nombre;
        $tipo->condicion ='1';
        $tipo->save();
    }
    public function desactivar(Request $request)
    {
        $tipo = Tipo::findOrFail($request->id);
        $tipo->condicion = '0';
        $tipo->save();
    }
    public function activar(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $tipo = Tipo::findOrFail($request->id);
        $tipo->condicion ='1';
        $tipo->save();
    }
    public function selectTipo(Request $request){
       // if (!$request->ajax()) return redirect('/');
        $tipos = Tipo:://where('condicion','=','1')
        select('id','nombre')->orderBy('nombre','asc')->get();
        return ['tipos' => $tipos];

    }
}
