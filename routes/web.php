<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


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
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
     
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
     
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
 
Route::group(['middleware' => ['Tecnico']], function () {
    
    Route::get('/equipo','EquipoController@index');
    Route::post('/equipo/registrar','EquipoController@store');
    Route::put('/equipo/actualizar','EquipoController@update');
    Route::put('/equipo/activar','EquipoController@activar');
    Route::put('/equipo/desactivar','EquipoController@desactivar');

    Route::get('/tipo','TipoController@index');
    Route::post('/tipo/registrar','TipoController@store');
    Route::put('/tipo/actualizar','TipoController@update');
    Route::put('/tipo/activar','TipoController@activar');
    Route::put('/tipo/desactivar','TipoController@desactivar');
    Route::get('/tipo/selectTipo','TipoController@selectTipo');

    Route::get('/cuerpotecnico','CuerpoTecnicoController@index');
    Route::post('/cuerpotecnico/registrar','CuerpoTecnicoController@store');
    Route::put('/cuerpotecnico/actualizar','CuerpoTecnicoController@update');

    Route::get('/jugador','JugadorController@index');
    Route::post('/jugador/registrar','JugadorController@store');
    Route::post('/jugador/actualizar','JugadorController@update');
    Route::get('/jugador/listarJugador','JugadorController@listarJugador');
});

Route::group(['middleware' => ['Administrador']], function () {
    Route::get('/sede','SedeController@index');
    Route::post('/sede/registrar','SedeController@store');
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

    });

});

//Route::get('/main','Auth\LoginController@showLoginForm');
//Route::post('/login','Auth\LoginController@login')->name('login');

//Route::get('/home', 'HomeController@index')->name('home');
