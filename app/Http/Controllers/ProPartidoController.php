<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipo;
use App\Torneo;
use App\DetalleTorneo;
use App\Programacion;
use App\Estadistica;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProPartidoController extends Controller
{
    public function index(Request $request)
    {
       $eq = array();      
              
       // $equipo = Equipo::select('nombre')->get();
       //$id = 9;//$request->idtorneo;
       $equipo = DB::table('equipos as a')
       ->join('detalle_torneos as b','a.id','=','b.idequipo')
       ->join('torneos as c','b.idtorneo','=','c.id')
       //->join('programacions as e','b.id','=','e.id')
       ->select('a.id','c.nombre as torneo','a.nombre as nombre')
       ->where('c.id','=',$request->idtorneo)       
       ->groupBy('b.idequipo')
       ->get();
       //$id = id; 
       //select a.id, c.nombre, a.nombre as equipo from equipos as a inner join detalle_torneos as b on a.id = b.idequipo 
       //inner join torneos as c on b.idtorneo = c.id where c.id = 1
      // $array = array();
       foreach($equipo as $t ){
            $eq[] = $t;
            //$eq[]= $t->id;
            //$tor[] = $torneo->torneo;
         //->orderBy('equipos.id', 'desc')->paginate(6);
        // $tde: total de equipos
                $tde = count($eq);
        // $tdppj: total de partidos por jornada
                    $tdppj = (integer)($tde/2);
        // $tdj: total de jornadas
                        $tdj = $tde - 1;
        // $pdp: arreglo de planificación de partidos.
        // Almacena los índices de los partidos que
        // van quedando
        // programados en cada jornada
                            $pdp = array();
        // $tdt: Tabla de trabajo
        // El contenido de este arreglo se va modificando
        // en cada jornada y sus datos
        // son considerandos en las siguientes jornadas.
                                $tdt = array();
        // Función para mostrar datos
        
        // Creando la primera jornada
                                    $index = 0;
        // $k: índice de donde tomará el segundo equipo
        // para la primera jornada
            if($tde % 2 == 0)
                $k = $tdppj;
            else
                $k = $tdppj + 1;
            for($i = 0;$i<$tdppj;$i++){
                $pdp[$i] = array($i,$k,1);
                    $tdt[$i] = array($i,$k);
                        $index++;
                            $k++;
            }
        // Creando las siguientes jornadas
        if($tde % 2 == 0){
        // Si la cantidad de partidos es par
            for($j=2;$j<=$tdj;$j++){
        // $tmp: Primer valor de la segunda columna
             $tmp = $tdt[0][1];
        // $tmp2: Último valor de la primera columna
                $tmp2 = $tdt[$tdppj -1][0];
        // Subiendo a la primera fila el segundo valor
        // de la segunda columna
                 $tdt[0][1] = $tdt[1][1];
        // Rotando los valores en sentido antihorario,
        // excepto los de la primera fila.
                    for($i=1;$i<($tdppj-1);$i++){
                        $tdt[$i+1][0] = $tdt[$i][0];
                             $tdt[$i][1] = $tdt[$i+1][1];
                    }
        // Colocando en la segunda fila de la primera
        // columna el valor $tmp que esta en la primera
        // fila de la segunda columna.
                                $tdt[1][0]=$tmp;
        // Colocando en la última fila de la segunda columna
        // el valor $tmp2 que estaba en la última fila de la
        // primera columna.
                                    $tdt[$tdppj -1][1] = $tmp2;
        // Transfiriendo los datos de los partidos de la
        // jornada $j al arreglo definitivo de programación
        // de jornadas $pdj.
                        for($i=0;$i<$tdppj;$i++){
                            $pdp[$index] = array($tdt[$i][0],$tdt[$i][1],$j);
                                $index++;
                            }
                }
        }else{
        // Si la cantidad de partidos es impar.
            $tdj++; // cuando es impar hay una jornada más
        // Agregando el equipo que descansa en la primera jornada
                $pdp[$index] = array($tdppj,-1,1);
                    $tdt[$index] = array($tdppj,-1);
                        $index++;
        // Generando desde la jornada 2 en adelante.
            for($j=2;$j<=$tdj;$j++){
        // Creando una copia del valor de la ezquina superior
        // derecha.
                $tmp = $tdt[0][1];
        // Intercambiando los valores de las dos últimas
        // celdas de la primera columna.
                    $tmp2 = $tdt[$tdppj][0];
                        $tdt[$tdppj][0]=$tdt[$tdppj-1][0];
                            $tdt[$tdppj-1][0] = $tmp2; // Esta línea es opcional
        // porque su posición será ocupada por otro valor al
        // rotar los valores.
        // Rotando los valores de las celdas en sentido
        // antihorario excepto los de la última fila.
            for($i=($tdppj-1);$i > 0;$i--){
                $tdt[$i][0] = $tdt[$i-1][0];
                    $tdt[$tdppj-$i-1][1] = $tdt[$tdppj - $i][1];
            }
        // Moviendo el valor $tmp que estaba en la celda [0][1]
        // a la celda [0][0]
                        $tdt[0][0] = $tmp;
        // Moviendo el valor $tmp2 que estaba en la primera
        // columna de la penúltima fila (después del intercambio)
        // a la segunda columna de la misma fila(penúltima).
                            $tdt[$tdppj-1][1] = $tmp2;
        // Transfiriendo los datos de los nuevos partidos al
        // arreglo definitivo de jornadas porgramadas.
                for($i=0;$i<=$tdppj;$i++){
                    $pdp[$index] = array($tdt[$i][0],$tdt[$i][1],$j);
                        $index++;
                }
            }
        }
    }
        // Mostrando la programación de partidos
        $a = array();
        for($j = 1;$j <= $tdj;$j++){
            //mostrar("JORNADA " . $j,"h1");
            for($i=0;$i < $index;$i++){
                if($j==$pdp[$i][2]){
                    if($pdp[$i][1] != -1){
                        //mostrar($eq[$pdp[$i][0]]  . " vs " . $eq[$pdp[$i][1]],"p");
                        $a[]= array($eq[$pdp[$i][0]],$eq[$pdp[$i][1]],$j);
                    }else{
                        //mostrar($eq[$pdp[$i][0]]  . " descansa","p");
                            //$a[]= array($eq[$pdp[$i][0]] . $eq[$pdp[$i][0]]);
                                $a[]= array($eq[$pdp[$i][0]] , "Este equipo descansa",$j);
                    }
                }
            }
        }
        // return  $eq;         
        //$a[]= array('D','F');
      // return json_encode($a);
       return $a;
       // $eq[] = $array;               
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        try{
            DB::beginTransaction();
                            
        $programaciones = $request->programaciones;

        foreach($programaciones as $item=>$pro){
            $programacion = new Programacion();
            $programacion->jornada = $pro['jornada'];
            $programacion->equipo_a = $pro['ideq1'];
            $programacion->equipo_b = $pro['ideq2'];
            /*if ($programacion->equipo_b = $pro['ideq2'])
            $pro['ideq2'];
            else
                $pro['ideq2']== 0;*/
            $programacion->fecha = $request->fecha;
            $programacion->hora = $request->hora;
            $programacion->idsede = $request->idsede;               
            $programacion->idtorneo = $request->idtorneo;          
            $programacion->save();     
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }               
    }
    public function selectPro(Request $request){
        if (!$request->ajax()) return redirect('/'); 
        $Progra = DB::table('programacions')->select('id')->get();
        return['programacions' => $Progra];
    }

    public function programacionPdf(Request $request, $idtorneo){    
        //if (!$request->ajax()) return redirect('/'); 
        $protorneo = DB::table('programacions as a')
        ->join('torneos as b','a.idtorneo','=','b.id')
        ->select('b.nombre as torneo')
        ->where('b.id', '=', $idtorneo)
        ->orderBy('a.id','asc')->take(1)->get();

        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('a.id','a.jornada','equipoa.nombre as equipoA','equipob.nombre as equipoB','a.puntaje_a','a.puntaje_b','a.fecha','a.hora')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        $pdf = \PDF::loadView('pdf.programacion',['protorneo'=>$protorneo, 'propartido'=>$programacion]);
        return $pdf->stream('programacion.pdf');
    /*SELECT a.id, a.jornada, equipoa.nombre, equipob.nombre,c.nombre from programacions as a 
    INNER JOIN equipos as equipoa on a.equipo_a =equipoa.id 
    INNER JOIN equipos  as equipob ON a.equipo_b=equipob.id
    inner JOIN torneos as c on a.idtorneo= c.id*/
    }
    public function index1(Request $request){
        $idtorneo = $request->idtorneo;   
        $index1 = DB::table('programacions as a')
        ->join('sedes as b','a.idsede','=','b.id')
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('a.id as idpro','a.fecha','a.hora','b.nombre as nombre_sede','c.nombre as torneo')
        ->where('c.id','=',$idtorneo)->get();        
        return['index1'=>$index1];
    }
    public function listarproTec(Request $request, $idtorneo){
        //if (!$request->ajax()) return redirect('/'); 
        $idtorneo = $request->idtorneo;        
        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->join('sedes as e','a.idsede','=','e.id')
        ->select('a.id','a.jornada','equipoa.nombre as equipoA','equipob.nombre as equipoB','c.nombre as torneo','a.fecha','a.hora','e.nombre as nombre_sede')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        return [
           
            'prootec' => $programacion
        ];
    }
    public function programacionTecnicoPdf(Request $request, $idtorneo){    
        //if (!$request->ajax()) return redirect('/'); 
        $protorneo = DB::table('programacions as a')
        ->join('torneos as b','a.idtorneo','=','b.id')
        ->select('b.nombre as torneo')
        ->where('b.id', '=', $idtorneo)
        ->orderBy('a.id','asc')->take(1)->get();

        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->join('sedes as e','a.idsede','=', 'e.id')
        ->select('a.id','a.jornada','equipoa.nombre as equipoA','equipob.nombre as equipoB','a.fecha','a.hora','e.nombre as nombre_sede')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        $pdf = \PDF::loadView('pdf.programacionTecnico',['protorneo'=>$protorneo, 'propartido'=>$programacion]);
        return $pdf->stream('programacionTecnico.pdf');
    /*SELECT a.id, a.jornada, equipoa.nombre, equipob.nombre,c.nombre from programacions as a 
    INNER JOIN equipos as equipoa on a.equipo_a =equipoa.id 
    INNER JOIN equipos  as equipob ON a.equipo_b=equipob.id
    inner JOIN torneos as c on a.idtorneo= c.id*/
    }
    public function verProgramacion(Request $request){
        if (!$request->ajax()) return redirect('/'); 
        $idtorneo = $request->idtorneo;
        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('a.id','a.jornada','equipoa.id as idequipo_a','equipoa.nombre as equipoA','equipob.id as idequipo_b','equipob.nombre as equipoB','a.puntaje_a','a.puntaje_b', 'c.nombre as torneo','a.fecha','a.hora')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        return [
           
            'proo' => $programacion
        ];
    }
    public function buscarEstadistica(Request $request, $id){
        $buscar = DB::table('estadisticas')
        ->select('pj','pg','pp','pts')
        ->where('equipo_id', '=', 5)->get();
        return ['buscar' => $buscar];       
    }
    public function BuscarIdA(Request $request, $ida, $idb, $pa, $pb){
       // $pa = 45;
        //$pb = 12;
        if ($pa > $pb){
            $rpga = 1;
            $rpgb = 0;
            $rppa = 0;
            $rppb = 1;
        }
        //buscarEstadistica($id);            
        $est_equipoa = DB::table('estadisticas')
        ->select('pj','pg','pp','pts')
        ->where('equipo_id', '=', $ida)->get();

        foreach($est_equipoa as $t){
                $pj = $t->pj;
                $pg = $t->pg;
                $pp = $t->pp;
                $pts = $t->pts;
        }
        $spj = $pj + 1;
        $spg = $pg + $rpga;
        $spp = $pp + $rppa;
        $spts = ($spg * 2) + $spp;
            
        //$equipo_id = $request->equipo_id;
        $estadistica_a = DB::table('estadisticas')->where('equipo_id','=', $ida)
        ->update(['pj'=> $spj,'pg' => $spg, 'pp'=> $spp,'pts' =>$spts]);

        //ESTADISTICA EQUIPO B
        if ($pb<$pa){
            $rpga = 0;
            $rpgb = 1;
            $rppa = 1;
            $rppb = 0;
        }

        $est_equipo_b = DB::table('estadisticas')
        ->select('pj','pg','pp','pts')
        ->where('equipo_id', '=', $idb)->get();

        foreach($est_equipo_b as $t){
                $pj = $t->pj;
                $pg = $t->pg;
                $pp = $t->pp;
                $pts = $t->pts;
        }
        $spj = $pj + 1;
        $spg = $pg + $rpga;
        $spp = $pp + $rppa;
        $spts = ($spg * 2) + $spp;
            
        //$equipo_id = $request->equipo_id;
        $estadistica_b = DB::table('estadisticas')->where('equipo_id','=', $idb)
        ->update(['pj'=> $spj,'pg' => $spg, 'pp'=> $spp,'pts' =>$spts]);

        return ['pj' => $spp];
    }
    public function actualizarEstadistica(Request $request)   {
        $equipo_id = $request->equipo_id;
        $programacion = DB::table('estadisticas')->where('equipo_id','=', $equipo_id )
        ->update(['pj'=> $request->spj,'pg' =>$request->spg, 'pp'=> $request->spp,'pts' =>$request->pts]);
        /*UPDATE `estadisticas` SET `pj` = '12', `pg` = '12', 
        `pp` = '02', `pts` = '20' WHERE `estadisticas`.`id` = 1;*/
    }
    public function BuscarIdB(Request $request){
        $idtorneo = $request->idtorneo;
        $idprob = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('equipoa.id as idA','equipob.id as idB','a.puntaje_a','a.puntaje_b')
        ->where([['c.id','=',$idtorneo],['a.id','=',21]])
        //->orWhere('a.id','=', 21)
        ->get();
        return [
           
            'idprob' => $idprob
        ];
    }
    
    public function update(Request $request)   {
        if (!$request->ajax()) return redirect('/'); 
        $id = $request->id;
        $ida = $request->idequipo_a;
        $idb = $request->idequipo_b;
        $idtorneo = $request->idtorneo;
    //    $ida = 3;
      //  $idb = 4;
        $pa = $request->puntaje_a;
        $pb = $request->puntaje_b;
        
        $programacion = DB::table('programacions')->where('id','=', $id)
        ->update(['puntaje_a'=> $request->puntaje_a,'puntaje_b' =>$request->puntaje_b]);

           $rpga = 0;
            $rpgb = 0;
            $rppa = 0;
            $rppb = 0;
            $pj = 0;
            $pg = 0;
            $pp = 0;
            $pts = 0;

        if ($pa > $pb){
            $rpga = 1;
            $rpgb = 0;
            $rppa = 0;
            $rppb = 1;
        }
        if ($pa < $pb){
            $rpga = 0;
            $rpgb = 1;
            $rppa = 1;
            $rppb = 0;
        }
        $est_equipoa = DB::table('estadisticas')
        ->select('pj','pg','pp','pts')
        ->where([['equipo_id', '=', $ida],['idtorneo', '=',$idtorneo]])->get();
        

        foreach($est_equipoa as $t){
                $pj = $t->pj;
                $pg = $t->pg;
                $pp = $t->pp;
                $pts = $t->pts;
        }
        $spj = $pj + 1;
        $spg = $pg + $rpga;
        $spp = $pp + $rppa;
        $spts = ($spg * 2) + $spp;
            
        $insert_estadistica = DB::table('estadisticas')->insert([
        'idtorneo' => $idtorneo, 'equipo_id'=> $ida,'pj'=>$pj,'pg'=>$pg,'pp'=>$pp,'pts'=>$pts]);

        $estadistica_a = DB::table('estadisticas')->where([['equipo_id','=', $ida],['idtorneo','=',$idtorneo]])
        ->update(['pj'=> $spj,'pg' => $spg, 'pp'=> $spp,'pts' =>$spts]);

        //ESTADISTICA EQUIPO B
        if ($pb > $pa){
            $rpga = 1;
            $rpgb = 0;
            $rppa = 0;
            $rppb = 1;
        }
        if ($pb < $pa){
            $rpga = 0;
            $rpgb = 1;
            $rppa = 1;
            $rppb = 0;
        }

        $est_equipo_b = DB::table('estadisticas')
        ->select('pj','pg','pp','pts')
        ->where([['equipo_id', '=', $idb],['idtorneo', '=',$idtorneo]])->get();

        foreach($est_equipo_b as $t){
                $pj = $t->pj;
                $pg = $t->pg;
                $pp = $t->pp;
                $pts = $t->pts;
        }
        $spj = $pj + 1;
        $spg = $pg + $rpga;
        $spp = $pp + $rppa;
        $spts = ($spg * 2) + $spp;
            
        //$equipo_id = $request->equipo_id;
        $insert_estadisticab = DB::table('estadisticas')->insert([
            'idtorneo' => $idtorneo, 'equipo_id'=> $idb,'pj'=>$pj,'pg'=>$pg,'pp'=>$pp,'pts'=>$pts]);
            
        $estadistica_b = DB::table('estadisticas')->where([['equipo_id','=', $idb],['idtorneo','=',$idtorneo]])
        ->update(['pj'=> $spj,'pg' => $spg, 'pp'=> $spp,'pts' =>$spts]);
        /* UPDATE `programacions` SET `puntaje_a` = '15', 
        `puntaje_b` = '20' WHERE `programacions`.`id` = 4;*/

    }
    public function obtenerPunto(Request $request){
       // if (!$request->ajax()) return redirect('/'); 
        $puntaje = DB::table('programacions')->count();
        return ['puntaje' => $puntaje];
    }

}
