<?php

namespace App\Http\Controllers;

use App\Models\Justificacione;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class JustificacionesController extends Controller
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
    public function index()
    {
            //join para consultar el nombre del cedis al que pertenece cada chofer
            $justificaciones = DB::table('justificaciones')
                ->join('eventos', 'justificaciones.id_evento', '=', 'eventos.id')
                ->select('justificaciones.*', 'eventos.nb_evento')
                ->get();
    
            //$motivoParadas = MotivoParada::with("motivo_paradas")->paginate(10);
            return view("justificaciones.index", compact("justificaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consultarEventos = DB::table('eventos')->get();;

        $justificacione = new Justificacione();
        $title = __("Crear nueva justificación de evento");
        $textButton = __("Crear");
        $route = route("justificaciones.store");
        return view("justificaciones.create", compact("title","textButton", "route", "justificacione", "consultarEventos"));
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

            "nb_justificacion" => "required|unique:justificaciones",
            "id_evento" => "required",
            "isActive" => "required",

        ]);

        Justificacione::create($request->only("nb_justificacion","id_evento","isActive"));
        return redirect(route("justificaciones.index"))
            ->with("success", __("¡JUstificación guardada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Justificacione  $justificacione
     * @return \Illuminate\Http\Response
     */
    public function show(Justificacione $justificacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Justificacione  $justificacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Justificacione $justificacione)
    {
        $consultarEventos = DB::table('eventos')->get();;


        $update = true;
        $title = __("Editar justificación del evento");
        $textButton = __("Actualizar");
        $route = route("justificaciones.update", [ "justificacione" => $justificacione]);
        return view("justificaciones.edit", compact("update","title","textButton", "route", "justificacione", "consultarEventos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Justificacione  $justificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Justificacione $justificacione)
    {
        $this->validate($request, [

            "nb_justificacion" => "required|max:140|unique:justificaciones,nb_justificacion," . $justificacione->id,
            "isActive" => "required",
            "id_evento" => "required",

        ]);

        $justificacione->fill($request->only("nb_justificacion","isActive","id_evento"))->save();
        return  back()->with("success", __("¡JUstificación  actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Justificacione  $justificacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Justificacione $justificacione)
    {
        //
    }
}
