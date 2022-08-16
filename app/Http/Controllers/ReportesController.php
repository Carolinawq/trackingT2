<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class reportesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $id_operacion = $request->id_operacion;


        return view("reportes.index", compact("id_operacion"));

    }


    public function consultarCedis(Request $request){

        $id_operacion = $request->id_operacion;

        $cedis = DB::table('detalle_cedis_operaciones')
        ->join('cedis', 'detalle_cedis_operaciones.id_cedis', '=', 'cedis.id')
        ->where('detalle_cedis_operaciones.id_operacion', "=", $id_operacion)
        ->select('cedis.id','cedis.nb_cedis')
        ->get();

        return response()->json($cedis);

        //echo $id_operacion;
    }


    public function generarReportes(Request $request){
        

        $id_cedis = $request->id_cedis;
        $fecha = $request->fecha;
        $id_operacion = $request->id_operacion;
        //formatear fecha para el reporte
        $fechaDMY = Carbon::parse($fecha)->format('d-m-Y');
        //echo 'cedis: '. $id_cedis. ' operacion: ' .$id_operacion. ' fecha: '.$fecha;
        $agruparEventos = DB::table('cedis')
        ->select(DB::raw('count(*) as total, eventos.nb_evento, justificaciones.nb_justificacion'))
        ->join('detalle_cedis_unidades', 'cedis.id', '=', 'detalle_cedis_unidades.id_cedis')
        ->join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
        ->join('detalle_eventos', 'unidades.id', '=', 'detalle_eventos.id_unidad')
        ->join('justificaciones', 'detalle_eventos.id_justificacion', '=', 'justificaciones.id')
        ->join('eventos', 'justificaciones.id_evento', '=', 'eventos.id')
        ->where('cedis.id', '=', $id_cedis)
        ->where('detalle_eventos.fecha_evento', '=', $fecha)
        ->where('unidades.id_operacion', '=', $id_operacion)
        ->groupBy('eventos.nb_evento')
        ->groupBy('justificaciones.nb_justificacion')
        ->get();
        

        $cedis = DB::table('cedis')
        ->where('cedis.id', '=', $id_cedis)
        ->select('cedis.nb_cedis')
        ->get();

        $operacion = DB::table('operaciones')
        ->where('operaciones.id', '=', $id_operacion)
        ->select('operaciones.nb_operacion')
        ->get();
        
        return view('reportes.plantillaReportes', compact('fechaDMY','cedis','operacion','fecha','id_cedis', 'id_operacion', 'agruparEventos'));

        //echo $agruparEventos;


    }


    public function eventosSeguridad(Request $request){

        $id_cedis = $request->id_cedis;
        $fecha = $request->fecha;
        $id_operacion = $request->id_operacion;
        //formatear fecha para el reporte
        $fechaDMY = Carbon::parse($fecha)->format('d-m-Y');


        $agruparEventos = DB::table('cedis')
        ->select(DB::raw('count(*) as total, eventos.nb_evento, justificaciones.nb_justificacion'))
        ->join('detalle_cedis_unidades', 'cedis.id', '=', 'detalle_cedis_unidades.id_cedis')
        ->join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
        ->join('detalle_eventos', 'unidades.id', '=', 'detalle_eventos.id_unidad')
        ->join('justificaciones', 'detalle_eventos.id_justificacion', '=', 'justificaciones.id')
        ->join('eventos', 'justificaciones.id_evento', '=', 'eventos.id')
        ->where('cedis.id', '=', $id_cedis)
        ->where('detalle_eventos.fecha_evento', '=', $fecha)
        ->where('unidades.id_operacion', '=', $id_operacion)
        ->groupBy('eventos.nb_evento')
        ->groupBy('justificaciones.nb_justificacion')
        ->get();


        return view('reportes.eventosSeguridad', compact('agruparEventos'));


    }

    public function descripcionEventos(Request $request)
        {

        $id_cedis = $request->id_cedis;
        $fecha = $request->fecha;
        $id_operacion = $request->id_operacion;

        $agruparEventos = DB::table('detalle_cedis_unidades')
        ->join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
        ->join('detalle_eventos', 'unidades.id', '=', 'detalle_eventos.id_unidad')
        ->join('justificaciones', 'detalle_eventos.id_justificacion', '=', 'justificaciones.id')
        ->join('eventos', 'justificaciones.id_evento', '=', 'eventos.id')
        ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
        ->where('unidades.id_operacion', '=', $id_operacion)
        ->where('detalle_eventos.fecha_evento', '=', $fecha)
        ->select('unidades.nb_unidad','eventos.nb_evento', 'detalle_eventos.hora_inicial', 'detalle_eventos.hora_final', 'detalle_eventos.ubicacion_inicial', 'detalle_eventos.ubicacion_final')
        ->get();
        

        //echo $agruparEventos;
        return view('reportes.descripcionEventos', compact('agruparEventos'));


            




            
    }




}
