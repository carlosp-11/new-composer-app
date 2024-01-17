<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index']);

Route::get('/productos', [ProductosController::class, 'index']);
Route::post('/productos', [ProductosController::class, 'filterOptions']);
Route::post('/filtrar/productos/{filtro}', [ProductosController::class, 'show']);
Route::get('/crear-producto', [ProductosController::class, 'create']);
Route::post('/crear-producto', [ProductosController::class, 'store']);
Route::get('productos/{id}/editar', [ProductosController::class, 'edit']);
Route::put('productos/{id}/editar', [ProductosController::class, 'update']);
Route::delete('productos/{id}', [ProductosController::class, 'destroy']);

Route::get('/almacenes', [AlmacenesController::class, 'index']);
Route::get('/crear-almacen', [AlmacenesController::class, 'create']);
Route::post('/crear-almacen', [AlmacenesController::class, 'store']);
Route::get('almacenes/{id}/editar', [AlmacenesController::class, 'edit']);
Route::put('almacenes/{id}/editar', [AlmacenesController::class, 'update']);
Route::delete('almacenes/{id}', [AlmacenesController::class, 'destroy']);

Route::get('/categorias', [CategoriasController::class, 'index']);
Route::get('/crear-categoria', [CategoriasController::class, 'create']);
Route::post('/crear-categoria', [CategoriasController::class, 'store']);
Route::get('categorias/{id}/editar', [CategoriasController::class, 'edit']);
Route::put('categorias/{id}/editar', [CategoriasController::class, 'update']);
Route::delete('categorias/{id}', [CategoriasController::class, 'destroy']);

//Route::resource('productos', App\Http\Controllers\ProductosController::class);


