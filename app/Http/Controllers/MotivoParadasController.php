<?php

namespace App\Http\Controllers;

use App\Models\MotivoParada;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class MotivoParadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        //join para consultar el nombre del cedis al que pertenece cada chofer
            $motivoParadas = DB::table('motivo_paradas')
            ->join('paradas', 'motivo_paradas.id_parada', '=', 'paradas.id')
            ->select('motivo_paradas.*', 'paradas.nb_parada')
            ->get();

        //$motivoParadas = MotivoParada::with("motivo_paradas")->paginate(10);
        return view("motivoParadas.index", compact("motivoParadas"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $consultarParadas = DB::table('paradas')->get();;

        $motivoParada = new MotivoParada();
        $title = __("Crear nuevo motivo de parada");
        $textButton = __("Crear");
        $route = route("motivoParadas.store");
        return view("motivoParadas.create", compact("title","textButton", "route", "motivoParada", "consultarParadas"));
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

            "nb_motivo_parada" => "required|unique:motivo_paradas",
            "id_parada" => "required",
            "isActive" => "required",

        ]);

        MotivoParada::create($request->only("nb_motivo_parada","id_parada","isActive"));
        return redirect(route("motivoParadas.index"))
            ->with("success", __("¡Motivo de parada guardado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MotivoParada  $motivoParada
     * @return \Illuminate\Http\Response
     */
    public function show(MotivoParada $motivoParada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MotivoParada  $motivoParada
     * @return \Illuminate\Http\Response
     */
    public function edit(MotivoParada $motivoParada)
    {

        $consultarParadas = DB::table('paradas')->get();;


        $update = true;
        $title = __("Editar motivo de parada");
        $textButton = __("Actualizar");
        $route = route("motivoParadas.update", [ "motivoParada" => $motivoParada]);
        return view("motivoParadas.edit", compact("update","title","textButton", "route", "motivoParada", "consultarParadas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MotivoParada  $motivoParada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MotivoParada $motivoParada)
    {
        $this->validate($request, [

            "nb_motivo_parada" => "required|max:140|unique:cedis,nb_cedis," . $motivoParada->id,
            "isActive" => "required",
            "id_parada" => "required",

        ]);

        $motivoParada->fill($request->only("nb_motivo_parada","isActive","id_parada"))->save();
        return  back()->with("success", __("¡Motivo de la parada actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotivoParada  $motivoParada
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoParada $motivoParada)
    {
        $motivoParada->delete();
        return back()->with("success", __("¡Motivo de la parada eliminada!"));
    }
}
