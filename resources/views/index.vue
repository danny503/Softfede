@extends('layouts.principal') <!--HEREDAMOS- hacemos referencia a la carpeta layouts y al archibo principal.blade.php solo basta la primera letra-->
@section('content') <!--aca hacemos refrencia a la seccion content y lo finalizamos en la parte de abajo-->
	
<template>
	

	<div class="header">
	<div class="top-header">
	<div class="logo">
			<a href="/"><img src="images/logo.png" alt="" /></a>
			<p>SOFTFEDES</p>
	</div>
	<div class="search">
			<form>
				<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
				<input type="submit" value="">
			</form>
	</div>
	<div class="clearfix"></div>
	</div>


<div class="header-info">
<h1>BALONCESTO ❤</h1>

<form method="POST" action="{{ route('login') }}">
@csrf
	
			<div class="form-group">				
			 <label>Usuario</label>
			 <input type="usuario" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus  placeholder="Nombre de usuario">
			 @if ($errors->has('usuario'))
                                    <span class="invalid-feedback" role="alert">
                                        
                                    </span>
           @endif
			</div>
		<div class="form-group">
			 <label>Contraseña</label>
			 <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  name="password" required placeholder="Contrase&ntilde;a">
			 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        
                                    </span>
             @endif
		</div>
		 <button type="submit" class="btn btn-primary">  {{ __('Login') }}</button> 


	
<!-- descripcion de la pelicula de la pagina -->

<p class="age"><a href="#">All Age</a> Don Hall, Chris Williams</p>
<p class="review">Rating	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  8,5/10</p>
<p class="review reviewgo">Genre	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; Animation, Action, Comedy</p>
<p class="review">Release &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; 7 November 2014</p>
<!-- <a class="video" href="#"><i class="video1"></i>WATCH TRAILER</a>
<a class="book" href="#"><i class="book1"></i>BOOK TICKET</a> -->
</div>
</div>


</template>
@endsection <!--finalizamos la seccion-->
