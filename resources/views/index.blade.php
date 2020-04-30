@extends('layouts.principal') <!--HEREDAMOS- hacemos referencia a la carpeta layouts y al archibo principal.blade.php solo basta la primera letra-->
@section('contenido')
<div id="app">
 <section id="contant" class="contant">
	<div class="container">
	   <div class="row">
		  <div class="col-lg-12 col-sm-6 col-xs-12">			
			 <programacionTecnico></programacionTecnico>
			 
			 <TablaPosicion></TablaPosicion>				 
		  </div>		 
	   </div>
	</div>
 </section>
</div>
@endsection <!--finalizamos la seccion-->
