<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\DetalleEvento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;




class EventosController extends Controller
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
        $eventos = Evento::with("eventos")->paginate(10);



        return view("eventos.index", compact("eventos"));
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evento = new Evento;
        $title = __("Crear eventos");
        $textButton = __("Crear");
        $route = route("eventos.store");
        return view("eventos.create", compact("title","textButton", "route", "evento"));

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

            "nb_evento" => "required|max:140|unique:eventos",
            "isActive" => "required",

        ]);

        Evento::create($request->only("nb_evento", "isActive"));
        return redirect(route("eventos.index"))
            ->with("success", __("¡Evento guardado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        $update = true;
        $title = __("Editar evento");
        $textButton = __("Actualizar");
        $route = route("eventos.update", [ "evento" => $evento]);
        return view("eventos.edit", compact("update","title","textButton", "route", "evento"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $this->validate($request, [

            "nb_evento" => "required|max:140|unique:eventos,nb_evento," . $evento->id,
            "isActive" => "required",

        ]);

        $evento->fill($request->only("nb_evento","isActive"))->save();
        return  back()->with("success", __("¡Evento actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();
        return back()->with("success", __("¡Evento eliminado!"));
    }


    public function tratarEventos(Request $Request)
    {
        $textButton = __("Registrar");
        $route = route("eventos.registrarEventos");

        if(!empty($fecha_parada)){
            $fecha_evento= $request->fecha_evento;
            $fecha_evento_imprimir = Carbon::parse($request->fecha_evento)->format("d-m-Y");


        }else{
            $fecha_evento= Carbon::now()->format("Y-m-d");
            $fecha_evento_imprimir = Carbon::parse($fecha_evento)->format("d-m-Y");

            //echo $fecha_ruta;
        }

        $operaciones = DB::table('operaciones')
        ->select('operaciones.*')
        ->get();

        return view("eventos.tratarEventos", compact("textButton", "route","fecha_evento","fecha_evento_imprimir", "operaciones"));

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

    public function consultarEventos(Request $request)
    {


        $eventos = DB::table('eventos')
        ->select('eventos.*')
        ->get();

        return response()->json($eventos);
    }

    public function consultarJustificacionEventos(Request $request)
    {

        $id_evento = $request->id_evento;


        $justificacionEventos = DB::table('justificaciones')
        ->where('justificaciones.id_evento', "=", $id_evento)
        ->select('justificaciones.*')
        ->get();

        return response()->json($justificacionEventos);
    }

    public function registrarEventos(Request $request)
    {

        $hora_inicial = new DateTime($request->hora_inicial);
        $hora_final = new DateTime($request->hora_final);

        //formatear fecha antes de poder hacer la resta y guardar
        $hora_inicial->format('%h:%i:%s');
        $hora_final->format('%h:%i:%s');
        $duracion_evento = $hora_inicial->diff($hora_final);
        $duracion_evento = $duracion_evento->format('%H:%I:%S');

        //se agrego composer require laravel/helpers en la terminal para agregar los helpers
        //agregar objeto $no_vuelta al array que llego a la funcion para insertar el no de vuelta correspiendiente
        $request = array_add($request, 'duracion_evento', $duracion_evento);



        $this->validate($request, [

            "fecha_evento" => "required",
            "id_unidad" => "required",
            "id_justificacion" => "required",
            "ubicacion_inicial" => "required",
            "ubicacion_final" => "nullable",
            "hora_inicial" => "required",
            "hora_final" => "nullable",
            "descripcion" => "required",
            "duracion_evento" => "nullable",


            ]);

    
            DetalleEvento::create($request->only("fecha_evento", "id_unidad", "id_justificacion" , "ubicacion_inicial", "ubicacion_final", "duracion_evento","hora_inicial", "hora_final","descripcion" ));
            return redirect()->back()->with("success", __("¡Evento registrado!"))->withInput();
  
    }

}
