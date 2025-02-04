<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','users.usuario','users.password',
            'users.estado','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.fechanac',
            'personas.genero','personas.direccion','personas.telefono',
            'personas.email','users.usuario','users.password',
            'users.estado','users.idrol','roles.nombre as rol')            
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

        $this->validate($request,[
            'email' => 'required|email|unique:personas',
            //'telefono' =>  'regex:/^ (\ + 36) [0-9]
            //{9} $ /',
            'telefono'=> 'max:8|min:8|regex:([0-9])',
            'usuario' => 'min:4|max:250|required|unique:users',
            'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:5',
           // 'usuario' => 'min:4|max:50|required',
            //'password' => 'min:5|max:250|required',        
        ]);         
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
 
            $user = new User();
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->estado = '1';
            $user->idrol = $request->idrol;          
 
            $user->id = $persona->id;
 
            $user->save();
           // return "Usuario Creado";
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }                  
    }
 
    public function update(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            //'telefono' =>  'required|min:15|numeric',
            'telefono'=> 'regex:([0-9])',
            //'usuario' => 'required|usuario|unique:users',
            //'usuario' => 'required|alpha',
            'usuario' => 'min:4|max:50|required',
            'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:5',
        ]);
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction(); 
            //Buscar primero el usuario a modificar
            $user = User::findOrFail($request->id);
            $persona = Persona::findOrFail($user->id);
 
            $persona->nombre = $request->nombre;
            $persona->fechanac = $request->fechanac;
            $persona->genero = $request->genero;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
              
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->estado = '1';
            $user->idrol = $request->idrol;
            $user->save();
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
 
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->estado = '1';
        $user->save();
    }
 
}
