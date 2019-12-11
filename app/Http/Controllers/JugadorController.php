<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;
use App\Persona;
use App\InscripcionJE;
use Illuminate\Support\Facades\DB;
class JugadorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','jugadores.estatura','jugadores.foto')
            ->orderBy('personas.id', 'desc')->paginate(5);
        }
        else{
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','jugadores.estatura','jugadores.foto')            
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(5);
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

    public function listarJugador(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','jugadores.estatura','jugadores.foto')
            ->orderBy('personas.id', 'desc')->paginate(6);
        }
        else{
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','jugadores.estatura','jugadores.foto')            
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(6);
        }
        
        return [ 'personas' => $personas ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = InscripcionJE::join('jugadores','inscripcionej.id','=','jugadores.id')
        ->join('personas','jugadores.id','=','personas.id')
        ->select('inscripcionej.id','inscripcionej.numero_camisa','inscripcionej.posicion','personas.nombre as persona')
        ->where('inscripcionej.idequipo','=',$id)
        ->orderBy('inscripcionej.id', 'desc')->get();

       
         
        return [
           
            'detalles' => $detalles
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $this->validate($request,[
            'nombre' => 'max:250|required|unique:personas',
            'email' => 'required|email|unique:personas',
            //'telefono' =>  'required|min:15|numeric',
            'telefono'=> 'regex:([0-9])',
            'foto' => 'mimes:jpg,jpeg,png|max:1000',
        
        ]);
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        }        
        
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

            $jugador = new Jugador();
            $jugador->estatura = $request->estatura;
            $jugador->foto = $name;
            $jugador->id = $persona->id;
            $jugador->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
        //return $request;

    }   

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        /*$this->validate($request,[
            'nombre' => 'max:250|required|unique:personas',
            'email' => 'required|email|unique:personas',
            //'telefono' =>  'required|min:15|numeric',
            'telefono'=> 'regex:([0-9])',
            'foto' => 'mimes:jpg,jpeg,png',
        
        ]);*/

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        }     
        
        try{
            DB::beginTransaction();

            //Buscar primero el jugador a modificar
            $jugador = Jugador::findOrFail($request->id);

            $persona = Persona::findOrFail($jugador->id);

            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
            
            $jugador->estatura = $request->estatura;
            $jugador->foto = $name;
            $jugador->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
      
}
