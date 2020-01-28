<?php

//Route::get('/','IndexController@index'); //CREAMOS LA RUTA DEL INDEX Y HACEMOS REFERENCIA AL CONTROLADOR Y SU METODO LLAMADO INDEX
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','IndexController@index'); 
Route::get('reviews','IndexController@reviews');
Route::get('/user','UserController@index');
    Route::post('/user/registrar','UserController@store');
    Route::put('/user/actualizar','UserController@update');
    Route::put('/user/activar','UserController@activar');
    Route::put('/user/desactivar','UserController@desactivar'); 
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
     
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
     
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
 
Route::group(['middleware' => ['Tecnico']], function () {
    
    Route::get('/equipo','EquipoController@index');
    Route::post('/equipo/registrar','EquipoController@store');
    Route::post('/equipo/actualizar','EquipoController@update');
    Route::put('/equipo/activar','EquipoController@activar');
    Route::delete('/equipo/borrar/{id}','EquipoController@destroy');
    Route::put('/equipo/desactivar','EquipoController@desactivar');
    Route::get('/equipo/listarEquipo','EquipoController@listarEquipo');
    Route::get('/equipo/obtenerCabecera', 'EquipoController@obtenerCabecera');
    Route::get('/equipo/obtenerDetalles', 'EquipoController@obtenerDetalles');
    Route::get('/equipo/listarPdf/{id}', 'EquipoController@listarPdf')->name('equipo_pdf'); 
    
    Route::post('/inscripcionej/registrar','InscripcionEJController@store');
    Route::delete('/inscripcionej/borrar/{id}','InscripcionEJController@destroy');
    Route::get('inscripcionej/destroy/{detalle_id}', ['as' => 'inscripcionej/destroy', 'uses'=>'InscripcionEJController@destroy']);
    Route::post('/inscripcionej/actualizar/{detalle_id}','InscripcionEJController@update');

    Route::get('/tipo','TipoController@index');
    Route::post('/tipo/registrar','TipoController@store');
    Route::put('/tipo/actualizar','TipoController@update');
    Route::put('/tipo/activar','TipoController@activar');
    Route::put('/tipo/desactivar','TipoController@desactivar');
    Route::get('/tipo/selectTipo','TipoController@selectTipo');

    Route::get('/cuerpotecnico','CuerpoTecnicoController@index');
    Route::post('/cuerpotecnico/registrar','CuerpoTecnicoController@store');
    Route::put('/cuerpotecnico/actualizar','CuerpoTecnicoController@update');
    Route::delete('/cuerpotecnico/borrar/{id}','CuerpoTecnicoController@destroy');

    Route::get('/jugador','JugadorController@index');
    Route::post('/jugador/registrar','JugadorController@store');
    Route::post('/jugador/actualizar','JugadorController@update');
    Route::delete('/jugador/borrar/{id}','JugadorController@destroy');
    Route::get('/jugador/listarJugador','JugadorController@listarJugador');
});

Route::group(['middleware' => ['Administrador']], function () {
    Route::get('/sede','SedeController@index');
    Route::post('/sede/registrar','SedeController@store');
    Route::get('/sede/selectSede','SedeController@selectSede');
    Route::put('/sede/actualizar','SedeController@update');
    Route::put('/sede/activar','SedeController@activar');
    Route::put('/sede/desactivar','SedeController@desactivar');

    Route::get('/rama','RamaController@index');
    Route::post('/rama/registrar','RamaController@store');
    Route::put('/rama/actualizar','RamaController@update');
    Route::put('/rama/activar','RamaController@activar');
    Route::put('/rama/desactivar','RamaController@desactivar');
    Route::get('/rama/selectRama','RamaController@selectRama');

    Route::get('/categoria','CategoriaController@index');
    Route::post('/categoria/registrar','CategoriaController@store');
    Route::put('/categoria/actualizar','CategoriaController@update');
    Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');

    Route::get('/puntaje','PuntajePartidoController@index');
    Route::post('/puntaje/registrar','PuntajePartidoController@store');
    Route::get('/puntaje/pdf/{id}', 'PuntajePartidoController@TopJugdorPdf')->name('puntaje');
    
    Route::get('/rol','RolController@index');
    Route::get('/rol/selectRol','RolController@selectRol');

    Route::get('/user','UserController@index');
    Route::post('/user/registrar','UserController@store');
    Route::put('/user/actualizar','UserController@update');
    Route::put('/user/activar','UserController@activar');
    Route::put('/user/desactivar','UserController@desactivar');
    
    Route::get('/jugador','JugadorController@index');
    Route::post('/jugador/registrar','JugadorController@store');
    Route::post('/jugador/actualizar','JugadorController@update');
    Route::get('/jugador/listarJugador','JugadorController@listarJugador');
    
    Route::get('/cuerpotecnico','CuerpoTecnicoController@index');
    Route::post('/cuerpotecnico/registrar','CuerpoTecnicoController@store');
    Route::put('/cuerpotecnico/actualizar','CuerpoTecnicoController@update');

    Route::get('/torneo','TorneoController@index');
    Route::post('/torneo/registrar','TorneoController@store');
    Route::put('/torneo/activar','TorneoController@activar');
    Route::put('/torneo/desactivar','TorneoController@desactivar');
    Route::put('/torneo/actualizar','TorneoController@update');
    Route::get('/torneo/obtenerCabecera', 'TorneoController@obtenerCabecera');
    Route::get('/torneo/obtenerDetalles', 'TorneoController@obtenerDetalles');
    Route::get('/torneo/pdf/{id}', 'TorneoController@pdf')->name('torneo_pdf');
    Route::get('/torneo/selectTorneo','TorneoController@selectTorneo');
    Route::post('/torneo/insertarEquipo', 'TorneoController@insertarEquipo');

    Route::post('/detalletorneo/registrar','TorneoDetalleController@store');

    Route::get('/propartido','ProPartidoController@index');
    Route::get('/propartido/listarprotec/{idtorneo}', 'ProPartidoController@listarproTec');
    Route::post('/propartido/registrar','ProPartidoController@store');
    Route::post('/propartido/actualizar/{id}','ProPartidoController@update');
    Route::get('/propartido/programacionPdf/{idtorneo}', 'ProPartidoController@programacionPdf')->name('programacion_pdf');   
    Route::get('/propartido/programaciontecnicoPdf/{idtorneo}', 'ProPartidoController@programacionTecnicoPdf')->name('programacionTecnico_pdf');   
    Route::get('/propartido/verprogramacion/{idtorneo}', 'ProPartidoController@verProgramacion');
    Route::get('/propartido/buscarida/{ida, idb, pa, pb}','ProPartidoController@BuscarIdA');
    Route::put('/propartido/actualizarestadistica','ProPartidoController@actualizarEstadistica');
    Route::get('/propartido/buscaridb/{idtorneo}','ProPartidoController@BuscarIdB');
    Route::get('/propartido/selectPro','ProPartidoController@selectPro');
    Route::get('/propartido/buscarestadistica/{id}','ProPartidoController@buscarEstadistica');
    Route::get('/propartido/obtenerpunto','ProPartidoController@obtenerPunto');

    Route::get('/estadistica','EstadisticaController@index');
    Route::post('/estadistica/registrar','EstadisticaController@store');

    Route::get('/arbitro','ArbitroController@index');
    Route::post('/arbitro/registrar','ArbitroController@store');
    Route::put('/arbitro/actualizar','ArbitroController@update');

    Route::get('/equipo','EquipoController@index');
    Route::post('/equipo/registrar','EquipoController@store');
    Route::post('/equipo/actualizar','EquipoController@update');
    Route::put('/equipo/activar','EquipoController@activar');
    Route::delete('/equipo/borrar/{id}','EquipoController@destroy');
    Route::put('/equipo/desactivar','EquipoController@desactivar');
    Route::get('/equipo/listarEquipo','EquipoController@listarEquipo');
    Route::get('/equipo/obtenerCabecera', 'EquipoController@obtenerCabecera');
    Route::get('/equipo/obtenerDetalles', 'EquipoController@obtenerDetalles');
    Route::get('/equipo/listarPdf/{id}', 'EquipoController@listarPdf')->name('equipo_pdf');   

    Route::delete('/detalletorneo/borrar/{id}','DetalleTorneoController@destroy');

    });

});

//Route::get('/main','Auth\LoginController@showLoginForm');
//Route::post('/login','Auth\LoginController@login')->name('login');

//Route::get('/home', 'HomeController@index')->name('home');
