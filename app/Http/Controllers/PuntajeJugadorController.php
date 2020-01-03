<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PuntajeJugador;

class PuntajeJugadorController extends Controller
{
    public function index(Request $request){
        
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $puntajej = new PuntajeJugador();
        $puntajej->puntaje = $request->puntaje;
        $puntajej->falta = $request->falta;
        $puntajej->idjugador = $
        $puntajej->save();
    }



}
