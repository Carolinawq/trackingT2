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
use App\Http\Controllers\VelocidadesController;
use App\Http\Controllers\ReportesController;














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


//routes del nav del layout
Route::get('/asignaciones/operacion/{id_operacion}', [AsignacionesController::class, 'index'])->name('asignaciones');
Route::get('/tratarParadas', [ParadasController::class, 'tratarParadas'])->name('tratarParadas');
Route::get('/tratarEventos', [EventosController::class, 'tratarEventos'])->name('tratarEventos');
Route::get('/velocidades/subirVelocidades', [VelocidadesController::class, 'subirVelocidades'])->name('subirVelocidades');
Route::get('/reportes/operacion/{id_operacion}', [ReportesController::class, 'index'])->name('reportes');



Route::get('/asignaciones/operacion/{id_operacion}/cedis/{id_cedis}', [AsignacionesController::class, 'registrarAsignacion'])->name('registrarAsignacion');

//ruta de la table unidades en ruta
Route::post('/asignaciones/store', [AsignacionesController::class, 'store'])->name('asignaciones.store');


Route::post('/asignaciones/tablaUnidadesRuta', [AsignacionesController::class, 'tablaUnidadesRuta'])->name('asignaciones.tablaUnidadesRuta');


Route::post('/tratarParadas/registrarParadas', [ParadasController::class, 'registrarParadas'])->name('paradas.registrarParadas');
Route::post('/tratarEventos/registrarEventos', [EventosController::class, 'registrarEventos'])->name('eventos.registrarEventos');


Route::post('/paradas/consultarUnidades',  [ParadasController::class, 'consultarUnidades'])->name('paradas.consultarUnidades');
Route::post('/eventos/consultarUnidades',  [EventosController::class, 'consultarUnidades'])->name('eventos.consultarUnidades');


Route::post('/paradas/consultarParadas',  [ParadasController::class, 'consultarParadas'])->name('paradas.consultarParadas');
Route::post('/eventos/consultarEventos',  [EventosController::class, 'consultarEventos'])->name('eventos.consultarEventos');


Route::post('/paradas/consultarMotivosParadas',  [ParadasController::class, 'consultarMotivosParadas'])->name('paradas.consultarMotivosParadas');
Route::post('/eventos/consultarJustificacionEventos',  [EventosController::class, 'consultarJustificacionEventos'])->name('eventos.consultarJustificacionEventos');


Route::post('/paradas/consultarCedis',  [ParadasController::class, 'consultarCedis'])->name('paradas.consultarCedis');

Route::post('/paradas/tablaParadas',  [ParadasController::class, 'tablaParadas'])->name('paradas.tablaParadas');

Route::post('/velocidades/importarVelocidades', [VelocidadesController::class, 'importarVelocidades'])->name('importarVelocidades');

Route::post('/reportes/consultarCedis',  [ReportesController::class, 'consultarCedis'])->name('consultarCedis');

Route::post('/reportes/generarReportes',  [ReportesController::class, 'generarReportes'])->name('generarReportes');

Route::post('/reportes/eventosSeguridad', [ReportesController::class, 'eventosSeguridad'])->name('eventosSeguridad');

Route::post('/reportes/plantillaReportes', [ReportesController::class, 'plantillaReportes'])->name('reportes.plantillaReportes');

Route::post('/reportes/eventosSeguridad',  [ReportesController::class, 'eventosSeguridad'])->name('reportes.eventosSeguridad');

Route::post('/reportes/descripcionEventos',  [ReportesController::class, 'descripcionEventos'])->name('reportes.descripcionEventos');

Route::post('/reportes/disponibilidadFlota',  [ReportesController::class, 'disponibilidadFlota'])->name('reportes.disponibilidadFlota');

Route::post('/reportes/utilizacionFlota',  [ReportesController::class, 'utilizacionFlota'])->name('reportes.utilizacionFlota');

Route::post('/reportes/informacionFlota',  [ReportesController::class, 'informacionFlota'])->name('reportes.informacionFlota');

Route::post('/reportes/otrasUnidades',  [ReportesController::class, 'otrasUnidades'])->name('reportes.otrasUnidades');

Route::post('/reportes/calcularExcesosVelocidad', [ReportesController::class, 'calcularExcesosVelocidad'])->name('reportes.calcularExcesosVelocidad');

Route::post('/reportes/velocidadGraficoDos', [ReportesController::class, 'velocidadGraficoDos'])->name('reportes.velocidadGraficoDos');

Route::post('/reportes/velocidadGraficoTres', [ReportesController::class, 'velocidadGraficoTres'])->name('reportes.velocidadGraficoTres');

Route::post('/reportes/incidencias', [ReportesController::class, 'incidencias'])->name('reportes.incidencias');

Route::post('/reportes/paradasAutorizadas', [ReportesController::class, 'paradasAutorizadas'])->name('reportes.paradasAutorizadas');

Route::post('/reportes/paradasNoAutorizadas', [ReportesController::class, 'paradasNoAutorizadas'])->name('reportes.paradasNoAutorizadas');





//Route::post('/eventos/guardarJustificacion', [EventosController::class, 'guardarJustificacion'])->name('eventos.guardarJustificacion');








