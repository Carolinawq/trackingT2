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
        ->select('unidades.nb_unidad','eventos.nb_evento', 'detalle_eventos.hora_inicial', 'detalle_eventos.hora_final','detalle_eventos.duracion_evento', 'detalle_eventos.ubicacion_inicial', 'detalle_eventos.ubicacion_final')
        ->get();
        

        //echo $agruparEventos;
        return view('reportes.descripcionEventos', compact('agruparEventos'));

            
    }


    public function disponibilidadFlota(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;

        $estatusUnidades = DB::table('detalle_cedis_unidades')
            ->select(DB::raw('count(*) as total, estatus_unidades.nb_estatus'))
            ->join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->groupBy('nb_estatus')
            ->having('total', '>', 0)
            ->get();

        $disponibles = 0;
        $noDisponibles = 0;
        $ruta = 0;
        $bajaDemanda = 0;
        $sinOperador = 0;
        $descompostura = 0;
        $baja = 0;
        $siniestrado = 0;
        $prestamo = 0;
        $taller = 0;
        $corralon = 0;

        foreach ($estatusUnidades as $row){
            //$disponibles = 0;
            if ($row->nb_estatus == 'Ruta'){
                    $ruta = $row->total;
            }
            if ($row->nb_estatus == 'Baja demanda'){
                $bajaDemanda = $row->total;
            }
            if ($row->nb_estatus == 'Sin operador'){
            $sinOperador = $row->total;
            }
            if ($row->nb_estatus == 'Descompostura'){
                $descompostura = $row->total;
            }
            if ($row->nb_estatus == 'Baja'){
                    $baja = $row->total;
            }
            if ($row->nb_estatus == 'Siniestrado'){
                $siniestrado = $row->total;
            }
            if ($row->nb_estatus == 'Prestamo'){
                $prestamo = $row->total;
            }
            if ($row->nb_estatus == 'Taller'){
                $taller = $row->total;
            }
            if ($row->nb_estatus == 'Corralon'){
                $corralon = $row->total;
            }

        }

        $disponibles = $ruta + $bajaDemanda + $sinOperador;
        $noDisponibles = $descompostura + $baja + $siniestrado + $prestamo + $taller + $corralon ;


        //echo $disponibles;
        //echo $noDisponibles;




        //echo $estatusUnidades;
        return view('reportes/disponibilidadFlota', compact('disponibles', 'noDisponibles'));

        //$respuesta = view('unidades/plantilla')->render();
        //return response()->json(array('success' => true, 'html'=>$respuesta));

    }

    public function utilizacionFlota(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;

        $estatusUnidades = DB::table('detalle_cedis_unidades')
            ->select(DB::raw('count(*) as total, estatus_unidades.nb_estatus'))
            ->join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->groupBy('nb_estatus')
            ->having('total', '>', 0)
            ->get();

 
        $fechaDMY = Carbon::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');



        //echo $estatus;
        /*return view('unidades/utilizacionFlota',compact('ruta'
                                                        , 'bajaDemanda'
                                                        , 'sinOperador'
                                                        , 'descompostura'
                                                        , 'baja'
                                                        , 'siniestrado'
                                                        , 'prestamo'
                                                        , 'taller'
                                                        , 'corralon'
                                                        , 'fechaDMY'
                                                    )); */   
        return view('reportes/utilizacionFlota', compact('estatusUnidades', 'fechaDMY'));


    }

    public function informacionFlota(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;

        $choferes = DB::table('estatus_unidades')
            ->join('detalle_est_unid_chof_rut_unids', 'estatus_unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades')
            ->join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->join('rutas', 'detalle_est_unid_chof_rut_unids.id_ruta', '=', 'rutas.id')
            ->join('detalle_cedis_unidades', 'unidades.id', '=', 'detalle_cedis_unidades.id_unidad')
            ->select('detalle_est_unid_chof_rut_unids.id','unidades.nb_unidad','detalle_est_unid_chof_rut_unids.no_vuelta','choferes.nb_chofer','choferes.nb_chofer_a_paterno', 'rutas.nb_ruta')
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->get();

        //echo $choferes;

        $sinChoferes = '';


        //contar el numero de choferes para ajustar los tamaño del resto de reportes
        $contador =  0; 

        foreach($choferes as $row){

            $sinChoferes = $row->nb_chofer;
            $contador= $contador + 1; 


        }

        if($sinChoferes != null){
            return view('reportes/informacionFlota', compact('choferes'));

        }else{
            return view('reportes/sinInformacionFlota');
        }

        //echo $choferes;



    }


    public function otrasUnidades(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;
        //siempre el estatus ruta debe ser el 1
        $id_estatus = 1;

        

        $otrasUnidades = DB::table('estatus_unidades')
            ->join('detalle_est_unid_chof_rut_unids', 'estatus_unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades')
            ->join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->join('detalle_cedis_unidades', 'unidades.id', '=', 'detalle_cedis_unidades.id_unidad')
            ->select('detalle_est_unid_chof_rut_unids.id','detalle_est_unid_chof_rut_unids.fecha_ruta','unidades.nb_unidad', 'estatus_unidades.nb_estatus')
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('estatus_unidades.id', '!=', $id_estatus)
            ->get();


        //echo $otrasUnidades;
        return view('reportes/otrasUnidades', compact('otrasUnidades'));


    }


    public function calcularExcesosVelocidad(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;

        //siempre el ruta ruta localdebe ser el 1
        $id_ruta_local = 1;
        //siempre el ruta ruta foranea debe ser el 2
        $id_ruta_foranea = 2;

        //siempre el estatus debe ser 1 (ruta)
        $id_estatus = 1;

        //maxima velocidad local 60
        $velocidadLocalMaxima = 60;

        //maxima velocidad foranea 100
        $velocidadForaneaMaxima = 100;
        
        //tiempo para ser considerado un exceso 60s
        $tiempo = 60;

        //consultar veces que excedio la velocidad cada chofer
        $consultaRepeticionLocalChofer = DB::table('velocidades')
            ->select('choferes.nb_chofer', 'unidades.nb_unidad', DB::raw('count(*) as total'))
            ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('choferes.id_cedis', '=', $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('velocidades.fecha', '=', $fecha)
            ->where('velocidades.velocidad', '>', $velocidadLocalMaxima)
            ->where('velocidades.duracion', '>', $tiempo)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
            ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_local)
            ->groupBy('unidades.nb_unidad')
            ->groupBy('choferes.nb_chofer')
            ->having('total', '>', 0)
            ->get();


        $consultaRepeticionForaneaChofer = DB::table('velocidades')
            ->select('choferes.nb_chofer', 'unidades.nb_unidad', DB::raw('count(*) as total'))
            ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('choferes.id_cedis', '=', $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('velocidades.fecha', '=', $fecha)
            ->where('velocidades.velocidad', '>', $velocidadForaneaMaxima)
            ->where('velocidades.duracion', '>', $tiempo)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
            ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_foranea)
            ->groupBy('unidades.nb_unidad')
            ->groupBy('choferes.nb_chofer')
            ->having('total', '>', 0)
            ->get();

        //echo $consultaRepeticionForaneaChofer;

        $local = '';
        foreach ($consultaRepeticionLocalChofer as $row){
            $local = $row->nb_unidad;
        }

        $foraneo = '';
        foreach ($consultaRepeticionForaneaChofer as $row){
            $foraneo = $row->nb_unidad;
        }
        

        if ($local == null && $foraneo == null){

            return view('reportes/sinExcesos');

        }else{
            return view('reportes/velocidades', compact('consultaRepeticionLocalChofer','consultaRepeticionForaneaChofer'));

        }  


        //echo $otrasUnidades;
        //return view('reportes/otrasUnidades', compact('otrasUnidades'));


    }

    public function velocidadGraficoDos(Request $request )
    {
               
        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;
        //siempre el estatus ruta debe ser el 1
        $id_estatus = 1;

               //siempre el ruta ruta localdebe ser el 1
        $id_ruta_local = 1;
        //siempre el ruta ruta foranea debe ser el 2
        $id_ruta_foranea = 2;

        //siempre el estatus debe ser 1 (ruta)
        $id_estatus = 1;

        //maxima velocidad local 60
        $velocidadLocalMaxima = 60;

        //maxima velocidad foranea 100
        $velocidadForaneaMaxima = 100;
        
        //tiempo para ser considerado un exceso 60s
        $tiempo = 60;


        //consultar cada exceso del chofer que excedio la velocidad mas veces
        $consultarNombreChoferConMasExcesos = DB::table('velocidades')
            ->select('choferes.nb_chofer', 'unidades.nb_unidad', DB::raw('count(*) as total'))
            ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('choferes.id_cedis', '=', $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('velocidades.fecha', '=', $fecha)
            ->where('velocidades.velocidad', '>', $velocidadLocalMaxima)
            ->where('velocidades.duracion', '>', $tiempo)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
            ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_local)
            ->groupBy('unidades.nb_unidad')
            ->groupBy('choferes.nb_chofer')
            ->having('total', '>', 0)
            ->orderBy('total', 'DESC')
            ->get()->first();


        if ($consultarNombreChoferConMasExcesos != null){

            foreach ($consultarNombreChoferConMasExcesos as $row){
                $choferMasExcesos = $consultarNombreChoferConMasExcesos->nb_chofer;
                $unidadMasExcesos = $consultarNombreChoferConMasExcesos->nb_unidad;
    
            }
    
            //echo $choferMasExcesos;

            $consultaRepeticionVelocidadLocalChofer= DB::table('velocidades')
                ->select('velocidades.velocidad', DB::raw('count(*) as total'))
                ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
                ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
                ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
                ->where('unidades.id_operacion', '=', $id_operacion)
                ->where('choferes.id_cedis', '=', $id_cedis)
                ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
                ->where('velocidades.fecha', '=', $fecha)
                ->where('velocidades.velocidad', '>', $velocidadLocalMaxima)
                ->where('velocidades.duracion', '>', $tiempo)
                ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
                ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_local)
                ->where('choferes.nb_chofer', '=', $choferMasExcesos)
                ->where('unidades.nb_unidad', '=', $unidadMasExcesos)
                ->groupBy('velocidades.velocidad')
                ->having('total', '>', 0)
                ->get();
    
            //echo $choferMasExcesos;
            //echo $unidadMasExcesos;

            return view('reportes/graficoDos', compact('consultaRepeticionVelocidadLocalChofer', 'choferMasExcesos', 'unidadMasExcesos'));
    
        }else{
            return view('reportes/sinExcesosLocales');
        }


        


    }

    public function velocidadGraficoTres(Request $request )
    {
               
        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;
        

               //siempre el ruta ruta localdebe ser el 1
        $id_ruta_local = 1;
        //siempre el ruta ruta foranea debe ser el 2
        $id_ruta_foranea = 2;

        //siempre el estatus debe ser 1 (ruta)
        $id_estatus = 1;

        //maxima velocidad local 60
        $velocidadLocalMaxima = 60;

        //maxima velocidad foranea 100
        $velocidadForaneaMaxima = 100;
        
        //tiempo para ser considerado un exceso 60s
        $tiempo = 60;

        //consultar cada exceso del chofer que excedio la velocidad mas veces
        $consultarNombreChoferConMasExcesos = DB::table('velocidades')
            ->select('choferes.nb_chofer', 'unidades.nb_unidad', DB::raw('count(*) as total'))
            ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
            ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
            ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('choferes.id_cedis', '=', $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
            ->where('velocidades.fecha', '=', $fecha)
            ->where('velocidades.velocidad', '>', $velocidadForaneaMaxima)
            ->where('velocidades.duracion', '>', $tiempo)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
            ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_foranea)
            ->groupBy('unidades.nb_unidad')
            ->groupBy('choferes.nb_chofer')
            ->having('total', '>', 0)
            ->orderBy('total', 'DESC')
            ->get()->first();




        if ($consultarNombreChoferConMasExcesos != null){

            foreach ($consultarNombreChoferConMasExcesos as $row){
                $choferMasExcesosForaneo = $consultarNombreChoferConMasExcesos->nb_chofer;
                $unidadMasExcesosForaneo = $consultarNombreChoferConMasExcesos->nb_unidad;
    
            }
    
            //echo $choferMasExcesos;
    
    
            //consultar veces que se repitio la misma velocidad del chofer con mas excesos
            $consultaRepeticionVelocidadForaneoChofer= DB::table('velocidades')
                ->select('velocidades.velocidad', DB::raw('count(*) as total'))
                ->join('unidades', 'unidades.nb_unidad', '=', 'velocidades.nb_unidad')
                ->join('detalle_est_unid_chof_rut_unids', 'unidades.id', '=', 'detalle_est_unid_chof_rut_unids.id_unidad')
                ->join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
                ->where('unidades.id_operacion', '=', $id_operacion)
                ->where('choferes.id_cedis', '=', $id_cedis)
                ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', '=', $fecha)
                ->where('velocidades.fecha', '=', $fecha)
                ->where('velocidades.velocidad', '>', $velocidadForaneaMaxima)
                ->where('velocidades.duracion', '>', $tiempo)
                ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', $id_estatus)
                ->where('detalle_est_unid_chof_rut_unids.id_ruta', '=', $id_ruta_foranea)
                ->where('choferes.nb_chofer', '=', $choferMasExcesosForaneo)
                ->where('unidades.nb_unidad', '=', $unidadMasExcesosForaneo)
                ->groupBy('velocidades.velocidad')
                ->having('total', '>', 0)
                ->get();
    
                return view('reportes/graficoTres', compact('consultaRepeticionVelocidadForaneoChofer', 'choferMasExcesosForaneo', 'unidadMasExcesosForaneo'));


        }else{
            return view('reportes/sinExcesosForaneos');
        }


    }

    public function incidencias(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;
        
        $agruparIncidencias = DB::table('paradas')
            ->select(DB::raw('count(*) as total, paradas.nb_parada'))
            ->join('motivo_paradas', 'paradas.id', '=', 'motivo_paradas.id_parada')
            ->join('detalle_paradas', 'motivo_paradas.id', '=', 'detalle_paradas.id_motivo_parada')
            ->join('unidades', 'detalle_paradas.id_unidad', '=', 'unidades.id')
            ->join('detalle_cedis_unidades', 'unidades.id', '=', 'detalle_cedis_unidades.id_unidad')
            ->where('unidades.id_operacion', '=', $id_operacion)
            ->where('detalle_paradas.fecha_parada', '=', $fecha)
            ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
            ->groupBy('paradas.nb_parada')
            ->having('total', '>', 0)
            ->get();

        //echo $agruparIncidencias;

        $incidencias = '';
        foreach($agruparIncidencias as $row){
            $incidencias = $row->nb_parada;
        }


        if ($incidencias != null ){ 
            return view('reportes/incidencias', compact('agruparIncidencias'));

        }else{
            return view('reportes/sinIncidencias');
        }
            
        //echo $agruparIncidencias;



    }

    public function paradasAutorizadas(Request $request)
    {
        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;


        $paradasAutorizadas = DB::table('paradas')
        ->select(DB::raw('count(*) as total, motivo_paradas.nb_motivo_parada'))
        ->join('motivo_paradas', 'paradas.id', '=', 'motivo_paradas.id_parada')
        ->join('detalle_paradas', 'motivo_paradas.id', '=', 'detalle_paradas.id_motivo_parada')
        ->join('unidades', 'detalle_paradas.id_unidad', '=', 'unidades.id')
        ->join('detalle_cedis_unidades', 'unidades.id', '=', 'detalle_cedis_unidades.id_unidad')
        ->where('unidades.id_operacion', '=', $id_operacion)
        ->where('detalle_paradas.fecha_parada', '=', $fecha)
        ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
        ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
        ->where('paradas.nb_parada', '=', 'Parada autorizada')
        ->groupBy('motivo_paradas.nb_motivo_parada')
        ->having('total', '>', 0)
        ->get();



            $autorizadas = '';
            foreach($paradasAutorizadas as $row){
                $autorizadas = $row->nb_motivo_parada;
            }
    
    
            if ($autorizadas != null ){ 
                return view('reportes/paradasAutorizadas', compact('paradasAutorizadas'));
    
            }else{
                return view('reportes/sinParadasAutorizadas');
            }
        //echo $paradasAutorizadas;




    }



    public function paradasNoAutorizadas(Request $request)
    {

        $id_operacion = $request->id_operacion;
        $fecha = $request->fecha;
        $id_cedis = $request->id_cedis;


        $paradasNoAutorizadas = DB::table('paradas')
        ->select(DB::raw('count(*) as total, motivo_paradas.nb_motivo_parada'))
        ->join('motivo_paradas', 'paradas.id', '=', 'motivo_paradas.id_parada')
        ->join('detalle_paradas', 'motivo_paradas.id', '=', 'detalle_paradas.id_motivo_parada')
        ->join('unidades', 'detalle_paradas.id_unidad', '=', 'unidades.id')
        ->join('detalle_cedis_unidades', 'unidades.id', '=', 'detalle_cedis_unidades.id_unidad')
        ->where('unidades.id_operacion', '=', $id_operacion)
        ->where('detalle_paradas.fecha_parada', '=', $fecha)
        ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
        ->where('detalle_cedis_unidades.id_cedis', '=', $id_cedis)
        ->where('paradas.nb_parada', '=', 'Parada no autorizada')
        ->groupBy('motivo_paradas.nb_motivo_parada')
        ->having('total', '>', 0)
        ->get();

        
            $noAutorizadas = '';
            foreach($paradasNoAutorizadas as $row){
                $noAutorizadas = $row->nb_motivo_parada;
            }
    
    
            if ($noAutorizadas != null ){ 
                return view('reportes/paradasNoAutorizadas', compact('paradasNoAutorizadas'));
    
            }else{
                return view('reportes/sinParadasNoAutorizadas');
            }

        //echo $paradasNoAutorizadas;




    }




}
