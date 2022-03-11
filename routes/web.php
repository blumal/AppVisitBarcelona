<?php

use App\Http\Controllers\MapController;
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

Route::get('/', function () {
    return view('welcome');
});

//Home customer de la web
Route::get('map', [MapController::class, 'index']);
//Obtenemos todos los marcadores en el mapa
Route::post('markets', [MapController::class, 'montarMarkets']);
//Vista filtrando por etiquetas
Route::post('filtro/{id}', [MapController::class, 'etiquetas']);
//Vista filtrando por favoritos