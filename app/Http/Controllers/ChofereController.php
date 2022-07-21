<?php

namespace App\Http\Controllers;

use App\Models\Chofere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ChofereController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


        //join para consultar el nombre del cedis al que pertenece cada chofer
        $choferes = DB::table('choferes')
        ->join('cedis', 'choferes.id_cedis', '=', 'cedis.id')
        ->select('choferes.*', 'cedis.nb_cedis')
        ->get();

        

        echo $choferes;

        /*$choferes = DB::table('choferes')
             ->select(DB::raw('count(*) as user_count, status'))
             ->where('status', '<>', 1)
             ->groupBy('status')
             ->get();*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $consultarCedis = DB::table('cedis')->get();;



        $chofere = new Chofere();
        $title = __("Crear nuevo operador");
        $textButton = __("Crear");
        $route = route("choferes.store");
        return view("choferes.create", compact("title","textButton", "route", "chofere", "consultarCedis"));
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

            "no_empleado" => "required|unique:choferes",
            "nb_chofer" => "required",
            "nb_chofer_a_paterno" => "required",
            "nb_chofer_a_materno" => "nullable",
            "id_cedis" => "required",
            "isActive" => "required",

        ]);

        Chofere::create($request->only("no_empleado","nb_chofer","nb_chofer_a_paterno","nb_chofer_a_materno","id_cedis", "isActive"));
        return redirect(route("choferes.index"))
            ->with("success", __("¡Centro de distribución guardado!"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chofere  $chofere
     * @return \Illuminate\Http\Response
     */
    public function show(Chofere $chofere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chofere  $chofere
     * @return \Illuminate\Http\Response
     */
    public function edit(Chofere $chofere)
    {

        $consultarCedis = DB::table('cedis')->get();
        $update = true;
        $title = __("Editar chofer");
        $textButton = __("Actualizar");
        $route = route("choferes.update", [ "chofere" => $chofere]);
        return view("choferes.edit", compact("update","title","textButton", "route", "chofere", "consultarCedis"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chofere  $chofere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chofere $chofere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chofere  $chofere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chofere $chofere)
    {
        $chofere->delete();
        return back()->with("success", __("¡Chofer eliminado!"));
    }
}
