<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Equipo;
use App\User;
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
            ->join('users','equipos.idusuario','=','users.id')
            ->select('equipos.id','equipos.idrama','equipos.nombre','equipos.idusuario','equipos.logo','ramas.nombre as nombre_rama' ,'users.usuario as nombre_usuario')
            ->where('users.id','=',Auth::id())
            
        //    SELECT a.*, b.usuario FROM equipos as a inner join users as b on a.idusuario = b.id where a.idusuario = b.usuario
            ->orderBy('equipos.id', 'desc')->paginate(6);
        }
        else{
            $equipos = Equipo::join('ramas','equipos.idrama','=','ramas.id')
            ->select('equipos.id','equipos.idrama','equipos.nombre','equipos.logo','ramas.nombre as nombre_rama')
            ->where('equipos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('equipos.id', 'desc')->paginate(6);           
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
        $this->validate($request,[    
            'logo' => 'dimensions:min_width=70,min_height=70,mimes:jpg,jpeg,png|max:1500',
            ]);

            
         if($request->hasFile('logo')){
            $file = $request->file('logo');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        }   
        try{
            DB::beginTransaction();       
        $equipo = new Equipo();
        $equipo->idrama = $request->idrama;
        $equipo->idusuario = \Auth::user()->id;
        $equipo->nombre = $request->nombre;
        $equipo->logo =  $name;
        $equipo->save();
        DB::commit();

    } catch (Exception $e){
        DB::rollBack();
    }

    }   
       
    public function listarPdf(Request $request,$id){
        $equipo = Equipo::join('ramas','equipos.idrama','=','ramas.id')
        ->select('equipos.id','equipos.nombre','ramas.nombre as nombre_rama')
        ->where('equipos.id','=',$id)
        ->orderBy('equipos.id','desc')->take(1)->get();
    
        $detalles = InscripcionJE::join('personas','inscripcionej.idjugador','=','personas.id')
        ->join('jugadores','inscripcionej.idjugador','=','jugadores.id')
        ->select('inscripcionej.posicion','personas.nombre as persona','jugadores.foto as foto')
        ->where('inscripcionej.idequipo','=',$id)
        ->orderBy('inscripcionej.id','desc')->get();
    
        $pdf = \PDF::loadView('pdf.equipo',['equipo'=>$equipo,'detalles'=>$detalles]);
        return $pdf->stream('equipo.pdf');
    
    }
        
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        //$name = "";
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        } 
        $equipo = Equipo::findOrFail($request->id);
        $equipo->idrama = $request->idrama;
        $equipo->nombre = $request->nombre;
        $equipo->logo = $name;
        $equipo->save();
    }
    public function listarEquipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $equipos = Equipo::join('ramas','equipos.idrama','=','ramas.id')
            ->select('equipos.id','equipos.nombre','ramas.nombre as nombre_rama')
            ->orderBy('equipos.id', 'desc')->paginate(6);
        }
        else{
            $equipos = Equipo::join('ramas','equipos.id','=','ramas.id')
            ->select('equipos.id','equipos.nombre','ramas.nombre as nombre_rama')            
            ->where('equipos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('equipos.id', 'desc')->paginate(6);
        }
        
        return [ 'equipos' => $equipos ];
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;

        $equipos = Equipo::join('ramas','equipos.idrama','=','ramas.id')
        ->select('equipos.id','equipos.idrama','equipos.nombre','ramas.nombre as nombre_rama')
        ->where('equipos.id','=',$id)
        ->orderBy('equipos.id', 'desc')->take(1)->get();

         
        return [
           
            'equipo' => $equipos
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
         
        $detalles = InscripcionJE::join('personas','inscripcionej.idjugador','=','personas.id')
        ->select('inscripcionej.numero_camisa','inscripcionej.posicion','personas.nombre as persona')
        ->where('inscripcionej.idequipo','=',$id)
        ->orderBy('inscripcionej.detalle_id', 'desc')->get();                    
         
        return [
           
            'detalles' => $detalles
        ];
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
    public function destroy(Request $request, $id)
    {        
        $equipo = Equipo::findOrFail($request->id);
        $equipo->delete();
        //Session::flash('message','Usuario eliminado correctamente');
    }
    
}
