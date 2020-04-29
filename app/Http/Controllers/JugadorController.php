<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;
use App\Persona;
use App\Equipo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class JugadorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->join('users','jugadores.idusuario','=','users.id')
            ->join('ramas','personas.idrama','=','ramas.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','jugadores.idusuario','ramas.nombre as nombre_rama','users.usuario as nombre_usuario','jugadores.estatura','jugadores.foto')
            ->where('users.id','=',Auth::id())
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
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        //$idrama = $request->idrama;
        
        if ($buscar==''){
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->join('users','jugadores.idusuario','=','users.id')
            ->join('equipos','equipos.idrama','=','personas.idrama')
            ->select('personas.id','personas.nombre')
            ->whereIn('personas.idrama', Equipo::select('idrama')->where('id','=', $request->idequipo)->get()->toArray())
            ->where('users.id','=',Auth::id())
            ->groupBy('personas.id')
            ->orderBy('personas.id', 'desc')->paginate(6);      
        }
        else{
            $personas = Jugador::join('personas','jugadores.id','=','personas.id')
            ->select('personas.id','personas.nombre')            
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(6);
        }

       /* $personas = DB::table('personas as a')
        ->join('jugadores as b','a.id','=','b.id')
        ->join('equipo as c','c.idrama','=','a.idrama')
        ->select('a.id','a.nombre')
        ->where('a.idrama','=' ,(DB::raw("select idrama from equipos where id=2")))
        ->groupBy('a.id')
        ->orderBy('a.id', 'desc')->get();
            /*$teams = DB::table('teams')
            ->select(DB::raw('select a.id, a.nombre from personas as a inner JOIN jugadores as b on a.id=b.id INNER JOIN 
            equipos as c on c.idrama=a.idrama where a.idrama= (select idrama from equipos where id=2) group by a.id ORDER BY a.id desc'))
            ->get();*/
            /*$personas = DB::table('personas as a')
            ->join('jugadores as b','a.id','=','b.id')
            ->join('users as e','b.idusuario','e.id')
            ->join('equipos as c','a.idrama','=','c.idrama')
            ->select('a.id','a.nombre')
            ->where('e.id','=',Auth::id())
            ->groupBy('a.id')
            ->orderBy('a.id','desc')->get();
            $buscar = $request->buscar;
            $criterio = $request->criterio;
            //$idrama = $request->idrama;                        
            /*select a.id, a.nombre from personas as a inner JOIN jugadores as b on a.id=b.id INNER JOIN 
            equipos as c on c.idrama=a.idrama where a.idrama=1 ORDER BY a.id DESC*/
        return [ 'personas' => $personas ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $request->validate([
            'nombre' => 'max:150|required|unique:personas',
            'email' => 'required|email|unique:personas',
            'telefono'=> 'regex:([0-9])',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);      
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/fotos/',$name);
        }               
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->idrama = $request->idrama;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $jugador = new Jugador();
            $jugador->estatura = $request->estatura;
            $jugador->foto = $name;
            $jugador->id = $persona->id;
            $jugador->idusuario = \Auth::user()->id;
            $jugador->save();
        //return $request;

    }   

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $request->validate([
            'nombre' => 'max:150|required|unique:personas'.$id,
            'email' => 'required|email|unique:personas' .$id,
            'telefono'=> 'regex:([0-9])',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/fotos/',$name);
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
    public function destroy(Request $request, $id)
    {        
        $persona = Persona::findOrFail($request->id);
        $persona->delete();
        //Session::flash('message','Usuario eliminado correctamente');
    }
      
}
