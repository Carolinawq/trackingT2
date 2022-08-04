<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;

class RutasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $rutas = Ruta::with("rutas")->paginate(10);
        return view("rutas.index", compact("rutas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruta = new Ruta();
        $title = __("Crear nueva ruta");
        $textButton = __("Crear");
        $route = route("rutas.store");
        return view("rutas.create", compact("title","textButton", "route", "ruta"));
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

            "nb_ruta" => "required|max:40|unique:rutas",
            "isActive" => "required",


        ]);

        Ruta::create($request->only("nb_ruta", "isActive"));
        return redirect(route("rutas.index"))
            ->with("success", __("¡Ruta guardada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show(Ruta $ruta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruta $ruta)
    {
        $update = true;
        $title = __("Editar ruta");
        $textButton = __("Actualizar");
        $route = route("rutas.update", [ "ruta" => $ruta]);
        return view("rutas.edit", compact("update","title","textButton", "route", "ruta"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruta $ruta)
    {
        $this->validate($request, [

            "nb_ruta" => "required|max:40|unique:rutas,nb_ruta," . $ruta->id,

        ]);

        $ruta->fill($request->only("nb_ruta"))->save();
        return  back()->with("success", __("¡Ruta actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruta $ruta)
    {
        
    }
}
