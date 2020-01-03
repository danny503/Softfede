@extends('layouts.principal')
@section('content')

<!--REPITE-->

<!--FIN REPITE-->

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<body>
	<!-- header-section-starts -->
	<div class="full">
<div class="wrap-content">
<?php
// programacion_jornadas.php
// Programación de jornadas deportivas para torneo de
// una vuelta.
// Método explicado por: Gerson Adalberto Gómez Urbina
// Programado por: Miguel Angel Cortez Vásquez
// mcortez_vasquez@yahoo.com
// Fecha: jueves 7 de septiembre de 2017
// Última modificación: domingo 10 de septiembre de 2017
$eq = array();
$eq[0] = "A";
$eq[1] = "B";
$eq[2] = "C";
$eq[3] = "D";
$eq[4] = "E";
$eq[5] = "F";
$eq[6] = "G";
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
function mostrar($texto,$f){
echo "<$f>$texto</$f>";
}
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
?>

</div>

		<div class="review-content">
			<div class="top-header span_top">
				<div class="logo">
					<a href="/"><img src="images/logo.png" alt="" /></a>
					<p>CINEMA MURPHY</p>
				</div>
				<div class="search v-search">
					<form>
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						<input type="submit" value="">
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="reviews-section">
				<h3 class="head">Movie Reviews</h3>
								<div class="col-md-9 reviews-grids">

{{--HACEMOS UN RECORRIDO CON LOS DATOS QUE NOS MANDA DESDE EL FrontController metodo reviews--}}

								

											<div class="review">
													<div class="movie-pic">
															
													</div>
											<div class="review-info">
														<a class="span" href="single.html">
														<i></i></a> {{-- mostramos del moviesfront que trae del modelo MOVIE su nombre--}}
															<p class="info">CAST:&nbsp;&nbsp;</p>
															<p class="info">DIRECTION:&nbsp;&nbsp;</p>
															<p class="info">GENRE:&nbsp;&nbsp;</p>
															<p class="info">DURATION:&nbsp;&nbsp;</p>
											</div>
											<div class="clearfix"></div>
										</div>
								
								</div>

							</div>
								<div class="clearfix"></div>
						</div>

					<div class="review-slider">
						 <ul id="flexiselDemo1">
							<li><img src="images/r1.jpg" alt=""/></li>
							<li><img src="images/r2.jpg" alt=""/></li>
							<li><img src="images/r3.jpg" alt=""/></li>
							<li><img src="images/r4.jpg" alt=""/></li>
							<li><img src="images/r5.jpg" alt=""/></li>
							<li><img src="images/r6.jpg" alt=""/></li>
						</ul>
					</div>
				</div>
</body>
<!--REPITE-->

<!--FIN REPITE-->
@endsection
