<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cedi;
use App\Models\DetalleEstUnidChofRutUnid;
use App\Models\Operacione;






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

        $operacion = $request->operacion;


        

        if (!empty($request->has('buscarCedi'))){
            $buscarCedi = $request->get('buscarCedi');

            $cedis = DB::table('operaciones')
            ->join('detalle_cedis_operaciones', 'operaciones.id', '=', 'detalle_cedis_operaciones.id_operacion')
            ->join('cedis', 'cedis.id', '=', 'detalle_cedis_operaciones.id_cedis')
            ->where('operaciones.id', "=", $operacion)
            ->select('detalle_cedis_operaciones.id_cedis','cedis.nb_cedis','cedis.id','nb_operacion')
            ->where('nb_cedis', "like", '%'.$buscarCedi.'%')
            ->distinct()->get();

            return view("asignaciones.index", compact("cedis", "operacion"));

        }else{

            

            $cedis = DB::table('operaciones')
            ->join('detalle_cedis_operaciones', 'operaciones.id', '=', 'detalle_cedis_operaciones.id_operacion')
            ->join('cedis', 'cedis.id', '=', 'detalle_cedis_operaciones.id_cedis')
            ->where('operaciones.id', "=", $operacion)
            ->select('cedis.nb_cedis','cedis.id','operaciones.nb_operacion', 'detalle_cedis_operaciones.id_cedis')
            ->distinct()->get();

            //echo $cedis;
            //echo $operacion;
            return view("asignaciones.index", compact("cedis", "operacion"));

            
        }





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cedi $cedi)
    {

        

        //join para consultar el nombre del cedis al que pertenece cada chofer
        /*$asignaciones = DB::table('detalle_EU_choferes_rutas_unidades')
            ->join('estatus_unidades', 'detalle_EU_choferes_rutas_unidades.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->join('rutas', 'detalle_EU_choferes_rutas_unidades.id_ruta', '=', 'rutas.id')
            ->join('unidades', 'detalle_EU_choferes_rutas_unidades.id_unidad', '=', 'unidades.id')
            ->select('estatus_unidades.nb_estatus', 'rutas.nb_ruta', 'unidades.nb_unidad')
            ->get();*/

        //echo $asignaciones;

        /*$asignaciones = DB::table('cedis')
            ->join('detalle_cedis_unidades', 'cedis.id', '=', 'detalle_cedis_unidades.id_cedis')
            ->join('detalle_EU_choferes_rutas_unidades', 'detalle_cedis_unidades.id_unidad', '=', 'detalle_EU_choferes_rutas_unidades.id_unidad')
            //->where('detalle_EU_choferes_rutas_unidades.fecha_ruta', '=', $fecha )
            ->select('cedis.nb_cedis')->distinct()->get();*/

            echo $cedi->id_cedis;
            //return view("asignaciones.agregarAsignacion", compact("cedi"));

            //return view("asignaciones.create", compact("cedis"));




            
        //return response()->json($asignaciones);
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
        $cedi = $request->id_cedis;
        $operacion = $request->id_operacion;



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
                return redirect(route("asignaciones.edit", [ "asignacione" => $cedi,  "operacione" =>  $operacion ]))
                ->with("success", __("¡Datos registrados!"));
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
            return redirect(route("asignaciones.edit", [ "asignacione" => $cedi,  "operacione" =>  $operacion ]))
            ->with("success", __("¡Datos registrados!"));


       }

       



       //echo 'unidad '.$id_unidad.'estatus '.$id_estatus.'chofer '.$id_chofer.'ruta '.' '.$id_ruta. 'fecha: '. $fecha;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function show(Cedi $cedi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function edit($cedi, Request $request)
    {
       /**la variable $asignacione contiene el id del cedis que se escogio desde la tabla asignacionesController.index*/
        

       $textButton = __("Guardar");
       $route = route("asignaciones.store");
       $cedi = $cedi;

       //id de la operacion recibido en el request
       $id_operacion = $request->operacione;
       //echo $operacion;


        $unidades = DB::table('detalle_cedis_unidades')
            ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
            ->where('unidades.isActive', "=", 1)
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $cedi)
            ->select('unidades.nb_unidad', 'unidades.id')
            ->get();


        $choferes = DB::table('choferes')
            ->where('choferes.id_cedis', "=", $cedi)
            ->select('choferes.id', 'choferes.nb_chofer', 'choferes.nb_chofer_a_paterno')
            ->get();


        $rutas = DB::table('rutas')
            ->select('rutas.*')
            ->get();

        $cedis = DB::table('cedis')
            ->where('cedis.id', "=", $cedi)
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
            ->where('choferes.id_cedis', "=", $cedi)
            ->get();


        $consultarOtrasUnidades = DB::table('detalle_est_unid_chof_rut_unids')
            ->Join('detalle_cedis_unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'detalle_cedis_unidades.id_unidad')
            ->Join('unidades', 'detalle_est_unid_chof_rut_unids.id_unidad', '=', 'unidades.id')
            ->Join('estatus_unidades', 'detalle_est_unid_chof_rut_unids.id_estatus_unidades', '=', 'estatus_unidades.id')
            ->where('unidades.id_operacion', "=", $id_operacion)
            ->where('detalle_cedis_unidades.id_cedis', "=", $cedi)
            ->where('detalle_est_unid_chof_rut_unids.id_estatus_unidades', "!=", 1)
            ->select('unidades.nb_unidad', 'estatus_unidades.nb_estatus', 'detalle_est_unid_chof_rut_unids.id')
            ->get();




        //echo $consultarAsignaciones;
        return view("asignaciones.edit", compact("unidades","estatusUnidades", "choferes", "rutas", "cedis", "textButton", "route", "consultarAsignaciones", "consultarOtrasUnidades", "id_operacion"));   

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cedi $cedi)
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
        return back()->with("success", __("¡Asignación eliminada!"));
    }
}
