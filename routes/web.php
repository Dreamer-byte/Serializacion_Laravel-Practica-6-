<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/{Nombre}','WebController@Saludar');

Route::get('/Calcular-Edad/{Nombre}/{Anyo}','WebController@ClacularEdad');

Route::get('/Comparar/{FirtsName}/{LastName}','WebController@Comparar');

Route::get('/Operacion/{Value1}/{Opc}/{Value2}','WebController@Operaciones');

/*Rutas del forulario */

Route::get('/alumno/create', 'AlumnoController@create');
Route::post('/alumno/insert', 'AlumnoController@insert');
Route::get('/alumno/list', 'AlumnoController@list');
/*Agregadas */
Route::get('/alumno/editar/{Carnet}','AlumnoController@editar');
Route::get('/alumno/borrar/{Carnet}','AlumnoController@borrar');
Route::post('/alumno/actualizar','AlumnoController@actualizar');

/**Auto */
Route::get('/auto/create', "AutoController@create");
Route::post('/auto/insert','AutoController@insert');
Route::get('/auto/list','AutoController@list');
Route::get('/auto/editar/{Placa}','AutoController@editar');
Route::post('/auto/actualizar','AutoController@actualizar');//Falta el de actualizar
Route::get('/auto/borrar/{Placa}','AutoController@borrar');
