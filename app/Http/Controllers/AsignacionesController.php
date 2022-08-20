<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cedi;
use App\Models\DetalleEstUnidChofRutUnid;
use App\Models\Operacione;
use Carbon\Carbon;






class AsignacionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $id_operacion = $request->id_operacion;

        $textButton = __("Registrar");


        if (!empty($request->has('buscarCedi'))){
            $buscarCedi = $request->get('buscarCedi');

            $cedis = DB::table('operaciones')
            ->join('detalle_cedis_operaciones', 'operaciones.id', '=', 'detalle_cedis_operaciones.id_operacion')
            ->join('cedis', 'cedis.id', '=', 'detalle_cedis_operaciones.id_cedis')
            ->where('operaciones.id', "=", $id_operacion)
            ->select('detalle_cedis_operaciones.id_cedis','cedis.nb_cedis','cedis.id','nb_operacion')
            ->where('nb_cedis', "like", '%'.$buscarCedi.'%')
            ->distinct()->get();

            return view("asignaciones.index", compact("cedis", "id_operacion", "textButton"));

        }else{

            

            $cedis = DB::table('operaciones')
            ->join('detalle_cedis_operaciones', 'operaciones.id', '=', 'detalle_cedis_operaciones.id_operacion')
            ->join('cedis', 'cedis.id', '=', 'detalle_cedis_operaciones.id_cedis')
            ->where('operaciones.id', "=", $id_operacion)
            ->select('cedis.nb_cedis','cedis.id','operaciones.nb_operacion', 'detalle_cedis_operaciones.id_cedis')
            ->distinct()->get();

            //echo $cedis;
            //echo $operacion;
            return view("asignaciones.index", compact("cedis", "id_operacion", "textButton"));

            
        }

    }


    public function registrarAsignacion(Request $request)
    {

        
        $id_operacion = $request->id_operacion;
        $id_cedis = $request->id_cedis;
        $fecha_ruta = $request->fecha_ruta;

        $textButton = __("Registrar");
        $route = route("asignaciones.store");


        //echo $id_cedis.$id_operacion.$fecha_ruta;


        $cedis = DB::table('cedis')
            ->where('cedis.id', "=", $id_cedis)
            ->select('cedis.*')
            ->get();


        /*$prestamos = DB::table('prestamos')
            ->where('cedis.id', "=", $id_cedis)*/



        //antes de contemplar los prestamos
        $unidades = DB::table('detalle_cedis_unidades')
            ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->where('unidades.isActive', "=", 1)
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $id_cedis)
            ->select('unidades.nb_unidad', 'unidades.id')
            ->get();


        /*$unidades = DB::table('prestamos')
            ->Join('detalle_cedis_unidades', 'prestamos.id_unidad', '=', 'detalle_cedis_unidades.id_unidad')
            ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->where('unidades.isActive', "=", 1)
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('prestamos.id_cedis_destino', "=", $id_cedis)
            ->select('unidades.nb_unidad', 'unidades.id')
            ->get();*/



        $choferes = DB::table('choferes')
            ->where('choferes.id_cedis', "=", $id_cedis)
            ->select('choferes.id', 'choferes.nb_chofer', 'choferes.nb_chofer_a_paterno')
            ->get();


        $rutas = DB::table('rutas')
            ->select('rutas.*')
            ->get();



        $estatusUnidades = DB::table('estatus_unidades')
            ->select('estatus_unidades.*')
            ->get();


        if(!empty($fecha_ruta)){
            $fecha_ruta= $request->fecha_ruta;

        }else{
            $fecha_ruta= Carbon::now()->format("Y-m-d");
            //echo $fecha_ruta;
        }

        $consultarAsignaciones = DB::table('detalle_est_unid_chof_rut_unids')
            ->Join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->Join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->Join('rutas', 'detalle_est_unid_chof_rut_unids.id_ruta', '=', 'rutas.id')
            ->Join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->select('unidades.nb_unidad','no_vuelta', 'choferes.nb_chofer','choferes.nb_chofer_a_paterno', 'rutas.nb_ruta', 'estatus_unidades.nb_estatus', 'detalle_est_unid_chof_rut_unids.no_vuelta', 'detalle_est_unid_chof_rut_unids.id')
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('choferes.id_cedis', "=", $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', "=", $fecha_ruta)
            ->orderBy('detalle_est_unid_chof_rut_unids.no_vuelta', 'asc')
            ->get(); 


        $consultarOtrasUnidades = DB::table('detalle_est_unid_chof_rut_unids')
            ->Join('detalle_cedis_unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'detalle_cedis_unidades.id_unidad')
            ->Join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->Join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', "!=", 1)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', "=", $fecha_ruta)
            ->select('unidades.nb_unidad', 'estatus_unidades.nb_estatus', 'detalle_est_unid_chof_rut_unids.id')
            ->get();



        //echo $unidades;
        return view("asignaciones.registrarAsignacion", compact("textButton", "route","cedis","unidades", "choferes", "rutas", "estatusUnidades", "id_operacion", "fecha_ruta", "consultarAsignaciones", "id_cedis", "consultarOtrasUnidades")); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tablaUnidadesRuta(Request $request)
    {
        //request asignado a variables para consultar si ya existe un registro con los mismos valores

        $fecha_ruta = $request->fecha_ruta;
        $fecha_imprimir = Carbon::parse($request->fecha_ruta)->format("d-m-Y");

        $id_cedis = $request->id_cedis;
        $id_operacion = $request->operacion;
        //$textButton = __("Guardar");
   //     $route = route("asignaciones.store");

   //antes de contemplar los prestamos
        $unidades = DB::table('detalle_cedis_unidades')
            ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->where('unidades.isActive', "=", 1)
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $id_cedis)
            ->select('unidades.nb_unidad', 'unidades.id')
            ->get();

     


        $choferes = DB::table('choferes')
            ->where('choferes.id_cedis', "=", $id_cedis)
            ->select('choferes.id', 'choferes.nb_chofer', 'choferes.nb_chofer_a_paterno')
            ->get();


        $rutas = DB::table('rutas')
            ->select('rutas.*')
            ->get();

        $cedis = DB::table('cedis')
            ->where('cedis.id', "=", $id_cedis)
            ->select('cedis.*')
            ->get();

        $estatusUnidades = DB::table('estatus_unidades')
            ->select('estatus_unidades.*')
            ->get();



        $consultarAsignaciones = DB::table('detalle_est_unid_chof_rut_unids')
            ->Join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->Join('choferes', 'detalle_est_unid_chof_rut_unids.id_chofer', '=', 'choferes.id')
            ->Join('rutas', 'detalle_est_unid_chof_rut_unids.id_ruta', '=', 'rutas.id')
            ->Join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->select('unidades.nb_unidad','no_vuelta', 'choferes.nb_chofer','choferes.nb_chofer_a_paterno', 'rutas.nb_ruta', 'estatus_unidades.nb_estatus', 'detalle_est_unid_chof_rut_unids.no_vuelta', 'detalle_est_unid_chof_rut_unids.id')
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('choferes.id_cedis', "=", $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', "=", $fecha_ruta)
            ->orderBy('detalle_est_unid_chof_rut_unids.id', 'asc')
            ->get();    
        //echo 'fecha: '.' '.$fecha.' cedi: '.$cedi.' id operacion: '.$id_operacion;

        $consultarOtrasUnidades = DB::table('detalle_est_unid_chof_rut_unids')
            ->Join('detalle_cedis_unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'detalle_cedis_unidades.id_unidad')
            ->Join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->Join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $id_cedis)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', "!=", 1)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', "=", $fecha_ruta)
            ->select('unidades.nb_unidad', 'estatus_unidades.nb_estatus', 'detalle_est_unid_chof_rut_unids.id')
            ->get();

        //return view('velocidades/velocidades', compact('consultaRepeticionLocalChofer','consultaRepeticionForaneoChofer'));
        return view("asignaciones.tablaUnidadesRuta", compact("unidades","estatusUnidades", "choferes", "rutas", "cedis", "id_operacion", "consultarAsignaciones", "consultarOtrasUnidades", "fecha_ruta", "fecha_imprimir"));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request asignado a variables para consultar si ya existe un registro con los mismos valores
        $id_unidad = $request->id_unidad;
        $id_estatus = $request->id_estatus_unidades;
        $id_chofer = $request->id_chofer;
        $id_ruta = $request->id_ruta;
        $fecha_ruta = $request->fecha_ruta;
        $id_cedis = $request->id_cedis;
        $id_operacion = $request->id_operacion;



        $consultar_no_vuelta = DB::table('detalle_est_unid_chof_rut_unids')
            ->where('detalle_est_unid_chof_rut_unids.id_unidad', "=", $id_unidad)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', "=", $id_estatus)
            ->where('detalle_est_unid_chof_rut_unids.fecha_ruta', "=", $fecha_ruta)
            ->select('detalle_est_unid_chof_rut_unids.no_vuelta')
            ->get();

        //consultar el no. de vuelta
        foreach($consultar_no_vuelta as $vuelta){
            $no_vuelta = $vuelta->no_vuelta;
           
        }

        //si el resultado es diferente de vacion aumentar una vuelta + 1, si no agregar la primer vuelta
        if (!empty($no_vuelta)){
            $no_vuelta = $no_vuelta + 1;

        }else{
            $no_vuelta = 1;

        }

        //se agrego composer require laravel/helpers en la terminal para agregar los helpers
        //agregar objeto $no_vuelta al array que llego a la funcion para insertar el no de vuelta correspiendiente
        $request = array_add($request, 'no_vuelta', $no_vuelta);

       //validar estatus para permitir valores nulos en el request
       if($id_estatus != 1){

            $this->validate($request, [

                "id_unidad" => "required",
                "id_estatus_unidades" => "required",
                "fecha_ruta" => "required",        
                ]);

                $asignacione = $request->id_cedis;
        
                DetalleEstUnidChofRutUnid::create($request->only("id_unidad", "id_estatus_unidades","fecha_ruta"));
                return redirect()->back()->with("success", __("¡Datos registrados!"))->withInput();

       }else{

        $this->validate($request, [

            "id_unidad" => "required",
            "id_estatus_unidades" => "required",
            "id_chofer" => "required",
            "id_ruta" => "required",
            "no_vuelta" => "required",
            "fecha_ruta" => "required",        
            ]);
    
            //contiene el id del cedi para regresar al mismo cedis despues de guardar
            $asignacione = $request->id_cedis;

            DetalleEstUnidChofRutUnid::create($request->only("id_unidad", "id_estatus_unidades", "id_chofer", "id_ruta", "fecha_ruta", "no_vuelta"));
            return redirect()->back()->with("success", __("¡Datos registrados!"))->withInput();


       }

       



       //echo 'unidad '.$id_unidad.'estatus '.$id_estatus.'chofer '.$id_chofer.'ruta '.' '.$id_ruta. 'fecha: '. $fecha;
    }


    public function show(DetalleEstUnidChofRutUnid $detalleEstUnidChofRutUnid)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleEstUnidChofRutUnid $asignacione)
    {
        $asignacione->delete();

        return redirect()->back()->with("success", __("¡Asignación eliminada!"));
    }
}
