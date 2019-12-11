<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
      $categorias = Categoria::all();
      return $categorias;
    }

   

   
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
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
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
    }

    public function selectCategoria(Request $request){
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria:://where('condicion','=','1')
        select('id','nombre','descripcion')->orderBy('nombre','asc')->get();
        return ['categorias' => $categorias];

    }


}
