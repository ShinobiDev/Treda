<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'UserController@login');

Route::post('crearTienda', 'TiendaController@crearTienda');
Route::put('actualizarTienda', 'TiendaController@actualizarTienda');
Route::post('showTienda', 'TiendaController@showTienda');
Route::get('getTiendas', 'TiendaController@getTiendas');
Route::delete('eliminarTienda', 'TiendaController@eliminarTienda');
