<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuerpoTecnico;
use App\Persona;
use Illuminate\Support\Facades\DB;
class CuerpoTecnicoController extends Controller
{
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $personas = CuerpoTecnico::join('personas','cuerpo_tecnico.id','=','personas.id')
            ->join('tipos','cuerpo_tecnico.idtipo','=','tipos.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','cuerpo_tecnico.idtipo','tipos.nombre as nombre_tipo')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas = CuerpoTecnico::join('personas','cuerpo_tecnico.id','=','personas.id')
            ->join('tipos','cuerpo_tecnico.idtipo','=','tipos.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','cuerpo_tecnico.idtipo','tipos.nombre as nombre_tipo')            
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }
 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
 
             
            $cuerpoT = new CuerpoTecnico();
            $cuerpoT->idtipo = $request->idtipo;
           // $cuerpoT->condicion = $request->condicion=1;

            $cuerpoT->id = $persona->id;
            $cuerpoT->save();
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
 
    }
 
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
 
            //Buscar primero el proveedor a modificar
            $cuerpoT = CuerpoTecnico::findOrFail($request->id);
 
            $persona = Persona::findOrFail($cuerpoT->id);
 
            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
 
             
            
            $cuerpoT->idtipo = $request->idtipo;
            $cuerpoT->save();
 
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
 
    }
}
