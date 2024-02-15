<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

//Ruta de Home
//Route::get('/', [MainController::class, 'index']);
Route::get('/', [UserController::class, 'index'])->name('login');

//Rutas de Productos
Route::get('/productos', [ProductosController::class, 'index'])->middleware(['web', 'auth']);;
Route::post('/productos', [ProductosController::class, 'show'])->middleware('auth');;
//Route::post('/filtrar/productos/{filtro}', [ProductosController::class, 'show'])->middleware('auth');;
Route::get('/crear-producto', [ProductosController::class, 'create'])->middleware('auth');;
Route::post('/crear-producto', [ProductosController::class, 'store'])->middleware('auth');;
Route::get('productos/{id}/editar', [ProductosController::class, 'edit'])->middleware('auth');;
Route::put('productos/{id}/editar', [ProductosController::class, 'update'])->middleware('auth');;
Route::delete('productos/{id}', [ProductosController::class, 'destroy'])->middleware('auth');;

//Rutas de Almacenes
Route::get('/almacenes', [AlmacenesController::class, 'index'])->middleware('auth');;
Route::get('/crear-almacen', [AlmacenesController::class, 'create'])->middleware('auth');;
Route::post('/crear-almacen', [AlmacenesController::class, 'store'])->middleware('auth');;
Route::get('almacenes/{id}/editar', [AlmacenesController::class, 'edit'])->middleware('auth');;
Route::put('almacenes/{id}/editar', [AlmacenesController::class, 'update'])->middleware('auth');;
Route::delete('almacenes/{id}', [AlmacenesController::class, 'destroy'])->middleware('auth');;

//Rutas de Categorias
Route::get('/categorias', [CategoriasController::class, 'index'])->middleware('auth');;
Route::get('/crear-categoria', [CategoriasController::class, 'create'])->middleware('auth');;
Route::post('/crear-categoria', [CategoriasController::class, 'store'])->middleware('auth');;
Route::get('categorias/{id}/editar', [CategoriasController::class, 'edit'])->middleware('auth');;
Route::put('categorias/{id}/editar', [CategoriasController::class, 'update'])->middleware('auth');;
Route::delete('categorias/{id}', [CategoriasController::class, 'destroy'])->middleware('auth');;

//Rutas de Login/Signup
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/signup', [UserController::class, 'create']);
Route::post('/signup', [UserController::class, 'store']);
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

//Routas de Área Personal
Route::get('/private', [UserController::class, 'show'])->middleware('auth');
//Route::post('/private', [UserController::class, ''])->middleware('auth');
Route::delete('/private', [UserController::class, 'destroy'])->middleware('auth');
