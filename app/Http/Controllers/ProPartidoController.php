<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipo;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProPartidoController extends Controller
{
    public function index()
    {
        $eq = array();              
       $equipo = Equipo::select('nombre')->get();
      // $array = array();
       foreach($equipo as $t){
        $eq[] = $t->nombre;
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
                                $a[]= array($eq[$pdp[$i][0]] , "",$j);
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
    public function proPdf(Request $request,$id){
        $eq = array();
        /*$eq[0] = "A";
        $eq[1] = "B";
        $eq[2] = "C";
        $eq[3] = "D";
        $eq[4] = "E";
        $eq[5] = "F";
        $eq[6] = "G";*/
      
       $equipo = Equipo::select('nombre')->get();
      // $array = array();
       foreach($equipo as $t){
        $eq[] = $t;
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
    function mostrar($texto,$f){
        echo "<$f>$texto</$f>";
        }
        // Mostrando la programación de partidos
        for($j = 1;$j <= $tdj;$j++){
        mostrar("JORNADA " . $j,"h1");
        for($i=0;$i < $index;$i++){
        if($j==$pdp[$i][2]){
        if($pdp[$i][1] != -1){
        mostrar($eq[$pdp[$i][0]]
        . " vs " . $eq[$pdp[$i][1]],"p");
        }else{
        mostrar($eq[$pdp[$i][0]]
        . " descansa","p");
        }
        }
        }
        }
       // return  $eq;              
       // $eq[] = $array;               
        $pdf = \PDF::loadView('pdf.propartido',['eq'=>$eq]);
        return $pdf->stream('programacion.pdf');
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');    
       
    }


}
