<?php

namespace App\Http\Controllers;

use App\Models\Cedi;
use App\Models\Chofere;

use Illuminate\Http\Request;

class CediController extends Controller
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
        $cedis = Cedi::with("cedis")->paginate(10);



        return view("cedis.index", compact("cedis"));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cedi = new Cedi;
        $title = __("Crear cedi");
        $textButton = __("Crear");
        $route = route("cedis.store");
        return view("cedis.create", compact("title","textButton", "route", "cedi"));
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

            "nb_cedis" => "required|max:140|unique:cedis",
            "pp" => "required",
            "pv" => "required",
            "isActive" => "required",

        ]);

        Cedi::create($request->only("nb_cedis","pp","pv", "isActive"));
        return redirect(route("cedis.index"))
            ->with("success", __("¡Centro de distribución guardado!"));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function edit(Cedi $cedi)
    {
        $update = true;
        $title = __("Editar cedi");
        $textButton = __("Actualizar");
        $route = route("cedis.update", [ "cedi" => $cedi]);
        return view("cedis.edit", compact("update","title","textButton", "route", "cedi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cedi $cedi)
    {
        $this->validate($request, [

            "nb_cedis" => "required|max:140|unique:cedis,nb_cedis," . $cedi->id,
            "pp" => "required",
            "pv" => "required",
            "isActive" => "required",

        ]);

        $cedi->fill($request->only("nb_cedis","pv","pp","isActive"))->save();
        return  back()->with("success", __("¡Operación actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cedi $cedi)
    {
        
    }
}
