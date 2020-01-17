<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipo;
use App\Torneo;
use App\DetalleTorneo;
use App\Programacion;
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
       ->select('a.id','c.nombre as torneo','a.nombre as nombre')
       ->where('c.id','=',$request->idtorneo)       
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
       return json_encode($a);
       return $a;
       // $eq[] = $array;               
    }

    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/'); 
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
            $programacion->idtorneo = $request->idtorneo;          
            $programacion->save();     
        }
        DB::commit();
    } catch (Exception $e){
        DB:rollBack();
        }               
    }
    public function selectPro(Request $request){
        $Progra = DB::table('programacions')->select('id')->get();
        return['programacions' => $Progra];
    }

    public function programacionPdf(Request $request, $idtorneo){    
        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('a.id','a.jornada','equipoa.nombre as equipoA','equipob.nombre as equipoB','a.puntaje_a','a.puntaje_b','c.nombre as torneo')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        $pdf = \PDF::loadView('pdf.programacion',['propartido'=>$programacion]);
        return $pdf->stream('programacion.pdf');
    /*SELECT a.id, a.jornada, equipoa.nombre, equipob.nombre,c.nombre from programacions as a 
    INNER JOIN equipos as equipoa on a.equipo_a =equipoa.id 
    INNER JOIN equipos  as equipob ON a.equipo_b=equipob.id
    inner JOIN torneos as c on a.idtorneo= c.id*/
    }
    public function verProgramacion(Request $request){
        $idtorneo = $request->idtorneo;
        $programacion = DB::table('programacions as a')
        ->join('equipos as equipoa','a.equipo_a','=','equipoa.id')
        ->join('equipos as equipob', 'a.equipo_b','=','equipob.id')        
        ->join('torneos as c','a.idtorneo','=','c.id')
        ->select('a.id','a.jornada','equipoa.nombre as equipoA','equipob.nombre as equipoB','a.puntaje_a','a.puntaje_b', 'c.nombre as torneo')       
        ->where('c.id','=',$idtorneo)
        ->orderBy('a.id','asc')
        ->get();
        return [
           
            'proo' => $programacion
        ];
    }
    public function update(Request $request)   {
        $id = $request->id;
        $programacion = DB::table('programacions')->where('id','=', $id )
        ->update(['puntaje_a'=> $request->puntaje_a,'puntaje_b' =>$request->puntaje_b]);
        /* UPDATE `programacions` SET `puntaje_a` = '15', 
        `puntaje_b` = '20' WHERE `programacions`.`id` = 4;*/
    }
    public function obtenerPunto(Request $request){
        $puntaje = DB::table('programacions')->count();
        return ['puntaje' => $puntaje];
    }

}
