<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DB;

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

//Vista

// Login (Inicio Sesion) //
Route::get('login',[MapController::class,'login']);
Route::post('loginpost',[MapController::class,'loginpost']);

// Logout (Cerrar Sesion) //
Route::post('logout',[MapController::class,'logout']);

// Registrar nuevo usuario //
Route::post('registro',[MapController::class,'registro']);

// Si el usuario logueado es Admin ira a esta página //
Route::get('admin',[MapController::class,'admin']);

// Mostrar usuarios AJAX //
Route::get('usuarios',[MapController::class,'mostrarUser']);
Route::post('filtro',[MapController::class,'show']);

// Crear usuarios //
Route::get('crear',[MapController::class,'crear']);
Route::post('crear',[MapController::class,'crearPost']);

// Modificar usuarios //
Route::get('modificar/{id}',[MapController::class,'modificar']);
Route::put('modificar',[MapController::class,'modificarPut']);

// Eliminar Usuarios //
Route::delete('eliminar/{id}',[MapController::class,'eliminar']);

//  Si el usuario logueado es Customer ira a esta página //
Route::get('map', [MapController::class, 'index']);

// Vista filtrando por etiquetas //
Route::post('etiquetas/{id}', [MapController::class, 'etiquetas']);

// Vista filtrando por favoritos