<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

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
}
