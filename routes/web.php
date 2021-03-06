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

// Login (Inicio Sesion) //
Route::get('login',[MapController::class,'login']);
Route::post('loginpost',[MapController::class,'loginpost']);
//
//Obtenemos todos los marcadores en el mapa
Route::post('markets', [MapController::class, 'montarMarkets']);

// Logout (Cerrar Sesion) //
Route::post('logout',[MapController::class,'logout']);

// Registrar nuevo usuario //
Route::post('registro',[MapController::class,'registro']);

// Si el usuario logueado es Admin ira a esta página //
Route::get('admin',[MapController::class,'mostrarUser']);

// Mostrar usuarios AJAX //
Route::get('usuarios',[MapController::class,'mostrarUser']);
Route::post('filtro',[MapController::class,'filtro']);

// CREAR RECURSOS //
Route::post('crear',[MapController::class,'crearPost']);
Route::post('crear',[MapController::class,'crear']);
Route::post('crear2',[MapController::class,'crear2']);

// ELIMINAR RECURSOS //
Route::delete('eliminar/{id}',[MapController::class,'eliminar']);
Route::delete('eliminar2/{id}',[MapController::class,'eliminar2']);

// ACTUALIZAR RECURSOS //
Route::put('actualizar',[MapController::class,'update']);
Route::put('actualizar2',[MapController::class,'update2']);

// Si el usuario logueado es Customer ira a esta página //
Route::get('map', [MapController::class, 'index']);

// Vista filtrando por etiquetas //
Route::post('etiquetas/{id}', [MapController::class, 'etiquetas']);

// Vista filtrando por favoritos

