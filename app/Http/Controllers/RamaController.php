<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rama;

class RamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ramas = Rama::all();
        return $ramas;
    }

    public function selectRama(Request $request){
        if (!$request->ajax()) return redirect('/');
        $ramas = Rama:://where('condicion','=','1')
        select('id','nombre')->orderBy('nombre','asc')->get();
        return ['ramas' => $ramas];

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
        $rama = new Rama();
        $rama->nombre = $request->nombre;
        $rama->save();
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

    
}
