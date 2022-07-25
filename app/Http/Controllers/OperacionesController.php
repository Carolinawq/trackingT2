<?php

namespace App\Http\Controllers;

use App\Models\Operacione;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class OperacionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //join para consultar el nombre del cedis al que pertenece cada chofer
            $operaciones = DB::table('operaciones')->get();
        
            //$motivoParadas = MotivoParada::with("motivo_paradas")->paginate(10);
            return view("operaciones.index", compact("operaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operacione = new Operacione();
        $title = __("Crear nueva operación");
        $textButton = __("Crear");
        $route = route("operaciones.store");
        return view("operaciones.create", compact("title","textButton", "route", "operacione"));
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

            "nb_operacion" => "required|max:140|unique:operaciones",
            "isActive" => "required",


        ]);

        Operacione::create($request->only("nb_operacion", "isActive"));
        return redirect(route("operaciones.index"))
            ->with("success", __("¡Operación guardada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operacione  $operacione
     * @return \Illuminate\Http\Response
     */
    public function show(Operacione $operacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operacione  $operacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Operacione $operacione)
    {
        $update = true;
        $title = __("Editar operacion");
        $textButton = __("Actualizar");
        $route = route("operaciones.update", [ "operacione" => $operacione]);
        return view("operaciones.edit", compact("update","title","textButton", "route", "operacione"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operacione  $operacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operacione $operacione)
    {
        $this->validate($request, [

            "nb_operacion" => "required|max:140|unique:operaciones,nb_operacion," . $operacione->id,
            "isActive" => "required",

        ]);

        $operacione->fill($request->only("nb_operacion","isActive"))->save();
        return  back()->with("success", __("¡Operación actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operacione  $operacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operacione $operacione)
    {
        //
    }
}
