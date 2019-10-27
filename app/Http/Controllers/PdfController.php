<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Jugador;
use App\Persona;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function index()
    {
        return view("pdf.listado_reportes");
    }

    public function crearPDF($datos,$vistaurl,$tipo)
    {

        $data = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }

    public function crear_reporte_porequipo($tipo){

        $vistaurl="pdf.reporte_por_equipo";
        $equipos=Equipo::all();
        
        return $this->crearPDF($equipos, $vistaurl,$tipo);
   
       }
}
