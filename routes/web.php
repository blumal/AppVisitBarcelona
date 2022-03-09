<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
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
Route::get('login',[MapController::class,'login']);
Route::post('loginpost',[MapController::class,'loginpost']);
Route::post('registro',[MapController::class,'registro']);
Route::get('admin',[MapController::class,'admin']);
Route::get('/crear',[MapController::class,'crear']);
Route::post('/crear',[MapController::class,'crearPost']);
Route::get('/modificar/{id}',[MapController::class,'modificar']);
Route::put('/modificar',[MapController::class,'modificarPut']);
Route::delete('/eliminar/{id}',[MapController::class,'eliminar']);
Route::get('usuarios',[MapController::class,'mostrarUser']);
Route::post('filtro',[MapController::class,'show']);
Route::post('crear',[MapController::class,'store']);
Route::delete('/eliminar2/{id}',[MapController::class,'eliminar2']);