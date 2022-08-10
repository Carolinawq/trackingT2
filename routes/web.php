<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CediController;
use App\Http\Controllers\OperacionesController;
use App\Http\Controllers\ChofereController;
use App\Http\Controllers\EstatusUnidadesController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\ParadasController;
use App\Http\Controllers\MotivoParadasController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\JustificacionesController;
use App\Http\Controllers\DetalleCedisOperacionesController;
use App\Http\Controllers\DetalleEventosController;
use App\Http\Controllers\UnidadesController;













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
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("choferes", ChofereController::class);  
Route::resource("cedis", CediController::class);
Route::resource("operaciones", OperacionesController::class);
Route::resource("estatusUnidades", EstatusUnidadesController::class);  
Route::resource("asignaciones", AsignacionesController::class);
Route::resource("rutas", RutasController::class);
Route::resource("paradas", ParadasController::class);
Route::resource("motivoParadas", MotivoParadasController::class);
Route::resource("eventos", EventosController::class);
Route::resource("justificaciones", JustificacionesController::class);
Route::resource("detalleCedisOperaciones", DetalleCedisOperacionesController::class);
Route::resource("detalleEventos", DetalleEventosController::class);
Route::resource("unidades", UnidadesController::class);

Route::get('/asignaciones/operacion/{id_operacion}', [AsignacionesController::class, 'index'])->name('asignaciones');


Route::get('/asignaciones/operacion/{id_operacion}/cedis/{id_cedis}', [AsignacionesController::class, 'registrarAsignacion'])->name('registrarAsignacion');

//ruta de la table unidades en ruta
Route::post('/asignaciones/store', [AsignacionesController::class, 'store'])->name('asignaciones.store');


Route::post('/asignaciones/tablaUnidadesRuta', [AsignacionesController::class, 'tablaUnidadesRuta'])->name('asignaciones.tablaUnidadesRuta');




//Route::post('/eventos/guardarJustificacion', [EventosController::class, 'guardarJustificacion'])->name('eventos.guardarJustificacion');








