<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Equipo;
use App\InscripcionJE;

class EquipoController extends Controller
{
    
    public function index(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $equipos = Equipo::join('ramas','equipos.idrama','=','ramas.id')
            ->select('equipos.id','equipos.idrama','equipos.nombre','ramas.nombre as nombre_rama')
            ->orderBy('equipos.id', 'desc')->paginate(4);
        }
        else{
            $equipos = Equipo::join('ramas','equipos.idrama','=','ramas.id')
            ->select('equipos.id','equipos.idrama','equipos.nombre','ramas.nombre as nombre_rama')
            ->where('equipos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('equipos.id', 'desc')->paginate(4);           
        }
        
        return [
            'pagination' => [
                'total'        => $equipos->total(),
                'current_page' => $equipos->currentPage(),
                'per_page'     => $equipos->perPage(),
                'last_page'    => $equipos->lastPage(),
                'from'         => $equipos->firstItem(),
                'to'           => $equipos->lastItem(),
            ],
            'equipos' => $equipos
        ];
    }

   
    public function store(Request $request)
    {
        
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $equipo = new Equipo();
        $equipo->idrama = $request->idrama;
        $equipo->nombre = $request->nombre;
        $equipo->logo = $request->logo;
        $equipo->save();

        $inscripciones = $request->data;//Array de detalles
        //Recorro todos los elementos

        foreach($inscripciones as $ep=>$det)
        {
            $inscripcion = new InscripcionJE();
            $inscripcion->idequipo = $equipo->id;
            $inscripcion->idjugador = $det['idpersona'];
           // $inscripcion->fecha_ingreso = $det['fecha_ingreso'];
            $inscripcion->numero_camisa = $det['ncamisa'];  
            $inscripcion->posicion = $det['posicion'];          
            $inscripcion->save();
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
    }          
}

    
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $equipo = Equipo::findOrFail($request->id);
        $equipo->idrama = $request->idrama;
        $equipo->nombre = $request->nombre;
        $equipo->logo = $request->logo;
        $equipo->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $equipo = Equipo::findOrFail($request->id);
        $equipo->condicion = '0';
        $equipo->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $equipo = Equipo::findOrFail($request->id);
        $equipo->condicion = '1';
        $equipo->save();
    }
  
}
