<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\CargaDatosController;
use App\Http\Controllers\ConexionController;
use App\Http\Controllers\UbicacionesController;
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

Route::get('/', function () {return view('welcome');});



Route::get('/RegistroRutas', [RutasController::class, 'index'] );
Route::post('/CreacionRutas',[RutasController::class,'registrarRuta']);
Route::post('/Registrar_conexiones', [ConexionController::class, 'registrar']);
Route::post('/guardar_ruta', [RutasController::class, 'guardar_ruta']);
Route::get('/cargarDatos', [CargaDatosController::class, 'index']);
Route::get('/cargarRutas', [RutasController::class, 'cargarRutas']);
Route::post('/Registrar_ubicaciones', [UbicacionesController::class,'Registrar_ubicaciones']);

Route::put('/modificarUbicacion/{id}', [UbicacionesController::class, 'modificarUbicaciones']);
Route::get('/cargarUbicaciones', [UbicacionesController::class, 'cargarUbicaciones']);
Route::get('/cargarConexiones', [ConexionController::class, 'cargarConexiones']);

