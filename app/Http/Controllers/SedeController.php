<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        return $sedes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sede = new Sede();
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->condicion = '1';
        $sede->save();
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
        $sede = Sede::findOrFail($request->id);
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->condicion = '1';
        $sede->save();
    }
    public function desactivar(Request $request)
    {
        $sede = Sede::findOrFail($request->id);
        $sede->condicion = '0';
        $sede->save();
    }
    public function activar(Request $request)
    {
        $sede = Sede::findOrFail($request->id);
        $sede->condicion = '1';
        $sede->save();
    }
}
