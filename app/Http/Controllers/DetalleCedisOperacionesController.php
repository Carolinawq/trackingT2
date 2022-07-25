<?php

namespace App\Http\Controllers;

use App\Models\DetalleCedisOperacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DetalleCedisOperacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        //join para consultar el nombre del cedis al que pertenece cada chofer
            $detalleCedisOperaciones = DB::table('detalle_cedis_operaciones')
            ->join('cedis', 'detalle_cedis_operaciones.id_cedis', '=', 'cedis.id')
            ->join('operaciones', 'detalle_cedis_operaciones.id_operacion', '=', 'operaciones.id')
            ->select('operaciones.*', 'cedis.nb_cedis')
            ->get();

        //$motivoParadas = MotivoParada::with("motivo_paradas")->paginate(10);

        return view("detalleCedisOperaciones.index", compact("detalleCedisOperaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consultarCedis = DB::table('cedis')->get();;
        $consultarOperaciones = DB::table('operaciones')->get();;

        $detalleCedisOperacione = new DetalleCedisOperacione();
        $title = __("Asignar operaciones a cedi");
        $textButton = __("Asignar");
        $route = route("detalleCedisOperaciones.store");
        return view("detalleCedisOperaciones.create", compact("title","textButton", "route", "detalleCedisOperacione", "consultarCedis","consultarOperaciones"));

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

            "id_cedis" => "required",
            "id_operacion" => "required",
            
        ]);

        //consultar si ya existe un registro con los datos del request para evitar registrados duplicados
        $obtenerOperacionesCedis = DB::table('detalle_cedis_operaciones')
                                        ->where('id_cedis', '=', $request->id_cedis)
                                        ->where('id_operacion', '=', $request->id_operacion)
                                        ->get();


        if($obtenerOperacionesCedis->isEmpty()){
            DetalleCedisOperacione::create($request->only("id_cedis","id_operacion"));
            return redirect(route("detalleCedisOperaciones.index"))->with("success", __("¡Operación asignada al cedis!"));
            }else{
                    echo 'Esta operación ya existe en este cedis, ningún cambio fue guardado.';
                    
            }
        
        

                

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleCedisOperacione  $detalleCedisOperacione
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleCedisOperacione $detalleCedisOperacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleCedisOperacione  $detalleCedisOperacione
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleCedisOperacione $detalleCedisOperacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleCedisOperacione  $detalleCedisOperacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleCedisOperacione $detalleCedisOperacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleCedisOperacione  $detalleCedisOperacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleCedisOperacione $detalleCedisOperacione)
    {
        //
    }
}
