<?php

namespace App\Http\Controllers;

use App\Models\EstatusUnidade;
use Illuminate\Http\Request;

class EstatusUnidadesController extends Controller
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
        $estatusUnidades = EstatusUnidade::with("estatus_unidades")->paginate(10);
        return view("estatusUnidades.index", compact("estatusUnidades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estatusUnidade = new EstatusUnidade();
        $title = __("Crear estatus de unidades");
        $textButton = __("Crear");
        $route = route("estatusUnidades.store");
        return view("estatusUnidades.create", compact("title","textButton", "route", "estatusUnidade"));
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

            "nb_estatus" => "required|max:140|unique:estatus_unidades",
            "isActive" => "required",

        ]);

        EstatusUnidade::create($request->only("nb_estatus", "isActive"));
        return redirect(route("estatusUnidades.index"))
            ->with("success", __("¡Estatus guardado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstatusUnidade  $estatusUnidade
     * @return \Illuminate\Http\Response
     */
    public function show(EstatusUnidade $estatusUnidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstatusUnidade  $estatusUnidade
     * @return \Illuminate\Http\Response
     */
    public function edit(EstatusUnidade $estatusUnidade)
    {
        $update = true;
        $title = __("Editar estatus");
        $textButton = __("Actualizar");
        $route = route("estatusUnidades.update", [ "estatusUnidade" => $estatusUnidade]);
        return view("estatusUnidades.edit", compact("update","title","textButton", "route", "estatusUnidade"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstatusUnidade  $estatusUnidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstatusUnidade $estatusUnidade)
    {
        $this->validate($request, [

            "nb_estatus" => "required|max:140|unique:estatus_unidades,nb_estatus," . $estatusUnidade->id,
            "isActive" => "required",

        ]);

        $estatusUnidade->fill($request->only("nb_estatus", "isActive"))->save();
        return  back()->with("success", __("¡Estatus actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstatusUnidade  $estatusUnidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstatusUnidade $estatusUnidade)
    {
        //
    }
}
