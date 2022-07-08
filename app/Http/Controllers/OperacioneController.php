<?php

namespace App\Http\Controllers;

use App\Models\Operacione;
use Illuminate\Http\Request;

class OperacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //metodo constructor para proteger estas rutas a usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $operaciones = Operacione::with("operaciones")->paginate(10);

        return view("operaciones.index", compact("operaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
