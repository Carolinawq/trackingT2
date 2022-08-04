<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class UnidadesController extends Controller
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

        //join para consultar el nombre de la operacion de cada unidad
            $unidades = DB::table('unidades')
                ->join('operaciones', 'unidades.id_operacion', '=', 'operaciones.id')
                ->select('unidades.*', 'operaciones.nb_operacion')
                ->get();

        //$unidades = Unidade::with("unidades")->paginate(10);
        return view("unidades.index", compact("unidades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $consultarOperaciones = DB::table('operaciones')->get();;

        $unidade = new Unidade;
        $title = __("Crear unidad");
        $textButton = __("Crear");
        $route = route("unidades.store");
        return view("unidades.create", compact("title","textButton", "route", "unidade", "consultarOperaciones"));
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

            "nb_unidad" => "required|max:140|unique:unidades",
            "id_operacion" => "required",
            "isActive" => "required",

        ]);

        Unidade::create($request->only("nb_unidad","isActive", "id_operacion"));
        return redirect(route("unidades.index"))
            ->with("success", __("¡Nueva unidad guardada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Unidade $unidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidade $unidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        //
    }
}
