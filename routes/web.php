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

Route::get('/lista-productos', [ProductosController::class, 'index']);

Route::get('/nuevo-producto', [ProductosController::class, 'create']);

Route::post('/nuevo-producto', [ProductosController::class, 'store']);

Route::resource('productos', App\Http\Controllers\ProductosController::class);

Route::get('/lista-categorias', [CategoriasController::class, 'index']);

Route::get('/nueva-categoria', [CategoriasController::class, 'create']);

Route::post('/nueva-categoria', [CategoriasController::class, 'store']);

Route::resource('categorias', App\Http\Controllers\CategoriasController::class);

Route::get('/lista-almacenes', [AlmacenesController::class, 'index']);

Route::get('/nuevo-almacen', [AlmacenesController::class, 'create']);

Route::post('/nuevo-almacen', [AlmacenesController::class, 'store']);

Route::resource('almacenes', App\Http\Controllers\AlmacenesController::class);

/*
Route::post('/', function () {
    // return view('index', [ProductosController::class, 'delete']);
 });
 */
/*
Route::get('/formulario', function () {
    return view('formulario',  ['categorias' => Categorias::all()]);
});
*/
/*
Route::post('/formulario', function () {
    return view('Procesando solicitud...');
});
*/

//Route::get('/productos/{producto}/editar', [ProductosController::class, 'edit']); 

/*
Route::get('/productos/{producto}/editar', function() {    
    return view('editarProducto', [ProductosController::class, 'edit']);
});
*/

//Route::resource('productos', App\Http\Controllers\ProductosController::class);
