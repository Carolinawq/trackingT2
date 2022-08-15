<?php

namespace App\Http\Controllers;

use App\Models\Parada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DetalleParada;




class ParadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $paradas = Parada::with("paradas")->paginate(10);
        return view("paradas.index", compact("paradas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parada = new Parada();
        $title = __("Crear nueva parada");
        $textButton = __("Crear");
        $route = route("paradas.store");
        return view("paradas.create", compact("title","textButton", "route", "parada"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            "nb_parada" => "required|max:140|unique:paradas",

        ]);

        Parada::create($request->only("nb_parada"));
        return redirect(route("paradas.index"))
            ->with("success", __("¡Parada guardada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parada  $parada
     * @return \Illuminate\Http\Response
     */
    public function show(Parada $parada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parada  $parada
     * @return \Illuminate\Http\Response
     */
    public function edit(Parada $parada)
    {
        $update = true;
        $title = __("Editar parada");
        $textButton = __("Actualizar");
        $route = route("paradas.update", [ "parada" => $parada]);
        return view("paradas.edit", compact("update","title","textButton", "route", "parada"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parada  $parada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parada $parada)
    {
        $this->validate($request, [

            "nb_parada" => "required|max:140|unique:paradas,nb_parada," . $parada->id,

        ]);

        $parada->fill($request->only("nb_parada"))->save();
        return  back()->with("success", __("¡Parada actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parada  $parada
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleParada $parada)
    {
        $parada->delete();
        return back()->with("success", __("¡Parada eliminada!"));
    }


    public function tratarParadas(Request $request)
    {

        $textButton = __("Registrar");
        $route = route("paradas.registrarParadas");

        if(!empty($fecha_parada)){
            $fecha_parada= $request->fecha_parada;

        }else{
            $fecha_parada= Carbon::now()->format("Y-m-d");
            //echo $fecha_ruta;
        }

        $operaciones = DB::table('operaciones')
        ->select('operaciones.*')
        ->get();

        return view("paradas.tratarParadas", compact("textButton","route","fecha_parada","operaciones"));
    }


    public function registrarParadas(Request $request)
    {

        $this->validate($request, [

            "fecha_parada" => "required",
            "id_unidad" => "required",
            "id_motivo_parada" => "required",
            "ubicacion" => "required",
            ]);

    
            DetalleParada::create($request->only("fecha_parada", "id_unidad","id_motivo_parada","ubicacion"));
            return redirect()->back()->with("success", __("¡Datos registrados!"))->withInput();

    }


    public function tablaParadas(Request $request)
    {

        $fecha_parada = $request->fecha_parada;

        $fecha_parada_imprimir = Carbon::parse($request->fecha_parada)->format("d-m-Y");


        //fecha_parada_imprimir = $fecha_parada->format("d-m-Y");

        $pollo_vivo = 1;
        $pollo_procesado = 2;


        //para llenar la tabla de paradas de pollo vivo
        $paradasPolloVivo = DB::table('cedis')
        ->Join('detalle_cedis_unidades', 'cedis.id', '=', 'detalle_cedis_unidades.id_cedis')
        ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
        ->Join('detalle_paradas', 'unidades.id', '=', 'detalle_paradas.id_unidad')
        ->Join('motivo_paradas', 'detalle_paradas.id_motivo_parada', '=', 'motivo_paradas.id')
        ->Join('paradas', 'motivo_paradas.id_parada', '=', 'paradas.id')
        ->Join('operaciones', 'operaciones.id', '=', 'unidades.id_operacion')
        ->where('detalle_paradas.fecha_parada', "=", $fecha_parada)
        ->where('unidades.id_operacion', "=", $pollo_vivo)
        ->select('detalle_paradas.id','cedis.nb_cedis','unidades.nb_unidad','operaciones.nb_operacion', 'motivo_paradas.nb_motivo_parada', 'paradas.nb_parada','detalle_paradas.fecha_parada', 'detalle_paradas.ubicacion')
        ->orderBy('detalle_paradas.id', 'desc')
        ->get();


        //para mostrar el nombre de la operacion en el head de la table
        $operacionPolloVivo = DB::table('operaciones')
        ->where('operaciones.id', "=", $pollo_vivo)
        ->select('operaciones.nb_operacion')
        ->get();

        $operacionPolloProcesado = DB::table('operaciones')
        ->where('operaciones.id', "=", $pollo_procesado)
        ->select('operaciones.nb_operacion')
        ->get();


                //para llenar la tabla de paradas de pollo vivo
        $paradasPolloProcesado = DB::table('cedis')
        ->Join('detalle_cedis_unidades', 'cedis.id', '=', 'detalle_cedis_unidades.id_cedis')
        ->Join('unidades', 'detalle_cedis_unidades.id_unidad', '=', 'unidades.id')
        ->Join('detalle_paradas', 'unidades.id', '=', 'detalle_paradas.id_unidad')
        ->Join('motivo_paradas', 'detalle_paradas.id_motivo_parada', '=', 'motivo_paradas.id')
        ->Join('paradas', 'motivo_paradas.id_parada', '=', 'paradas.id')
        ->Join('operaciones', 'operaciones.id', '=', 'unidades.id_operacion')
        ->where('detalle_paradas.fecha_parada', "=", $fecha_parada)
        ->where('unidades.id_operacion', "=", $pollo_procesado)
        ->select('detalle_paradas.id','cedis.nb_cedis','unidades.nb_unidad','operaciones.nb_operacion', 'motivo_paradas.nb_motivo_parada', 'paradas.nb_parada','detalle_paradas.fecha_parada', 'detalle_paradas.ubicacion')
        ->orderBy('detalle_paradas.id', 'desc')
        ->get();


        //echo $paradasPolloProcesado;
        return view("paradas.tablaParadas", compact("fecha_parada_imprimir", "paradasPolloVivo", "operacionPolloVivo", "paradasPolloProcesado", "operacionPolloProcesado"));   
    
    }



    public function consultarUnidades(Request $request)
    {

        $id_operacion = $request->id_operacion;



        $unidades = DB::table('unidades')
        ->where('unidades.id_operacion', "=", $id_operacion)
        ->select('unidades.*')
        ->get();

        return response()->json($unidades);
    }


    public function consultarParadas(Request $request)
    {


        $paradas = DB::table('paradas')
        ->select('paradas.*')
        ->get();

        return response()->json($paradas);
    }


    public function consultarMotivosParadas(Request $request)
    {

        $id_parada = $request->id_parada;


        $motivosParadas = DB::table('motivo_paradas')
        ->where('motivo_paradas.id_parada', "=", $id_parada)
        ->select('motivo_paradas.*')
        ->get();

        return response()->json($motivosParadas);
    }


    public function consultarCedis(Request $request)
    {

        $id_operacion = $request->id_operacion;



        $cedis = DB::table('detalle_cedis_operaciones')
        ->Join('cedis', 'detalle_cedis_operaciones.id_cedis', '=', 'cedis.id')
        ->where('detalle_cedis_operaciones.id_operacion', "=", $id_operacion)
        ->select('cedis.*')
        ->get();

        return response()->json($cedis);
    }








}
