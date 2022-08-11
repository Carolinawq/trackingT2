<?php

namespace App\Http\Controllers;

use App\Models\Parada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
    public function destroy(Parada $parada)
    {
        $parada->delete();
        return back()->with("success", __("¡Parada eliminada!"));
    }


    public function tratarParadas(Request $request)
    {

        $textButton = __("Registrar");
        $route = route("paradas.registrarParada");

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
