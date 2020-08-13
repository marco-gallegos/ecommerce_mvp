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

Route::get('/', 'ProductosController@catalogo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/catalogo', 'ProductosController@index')->name('catalogo.index');

//Route::get('/productos', 'ProductosController@list')->name('catalogo.list');
//Route::get('/productos/create', 'ProductosController@create')->name('catalogo.create');
//Route::post('/productos', 'ProductosController@store')->name('catalogo.store');
//Route::post('/productos/{id}', 'ProductosController@show')->name('catalogo.show');
//Route::put('/productos/{id}', 'ProductosController@update')->name('catalogo.edit');

Route::post('/movimientos/inventario/entrada', 'ProductosController@store_entrada')->name('movimiento.entrada');

Route::resource('productos', 'ProductosController');

Route::get('pagos', 'PagosController@index');
Route::post('pagos/pay', 'PagosController@pay');
