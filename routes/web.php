<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
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

Route::get('/', [ProductosController::class, 'index'])->name('home');

Route::get('/formulario', [CategoriasController::class, 'index']);

Route::post('/formulario', [ProductosController::class, 'store']);

Route::resource('formularios', App\Http\Controllers\ProductosController::class);
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