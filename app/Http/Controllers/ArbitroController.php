<?php

namespace App\Http\Controllers;
use App\Arbitro;
use App\Persona;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ArbitroController extends Controller
{
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $personas = Arbitro::join('personas','arbitros.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','arbitros.cargo')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas = Arbitro::join('personas','arbitros.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','arbitros.cargo')
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


            $arbitro = new Arbitro();
            $arbitro->cargo = $request->cargo;
           // $cuerpoT->condicion = $request->condicion=1;

            $arbitro->id = $persona->id;
            $arbitro->save();
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
            $arbitro = Arbitro::findOrFail($request->id);

            $persona = Persona::findOrFail($arbitro->id);

            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();



            $arbitro->cargo = $request->cargo;
            $arbitro->save();


            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
}
