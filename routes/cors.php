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

Route::post('crearProducto', 'ProductoController@crearProducto');
Route::put('actualizarProducto', 'ProductoController@actualizarProducto');
Route::post('mostrarProducto', 'ProductoController@mostrarProducto');
Route::post('listaProductoTienda', 'ProductoController@listaProductoTienda');
Route::get('getProductos', 'ProductoController@getProductos');
Route::delete('eliminarProducto', 'ProductoController@eliminarProducto');

Route::post('multiplos', 'FuncionesController@multiplos');
Route::post('remplazar', 'FuncionesController@remplazar');
Route::post('invertirPalabras', 'FuncionesController@invertirPalabras');