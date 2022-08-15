<?php

namespace App\Http\Controllers;

use App\Models\Velocidade;
use Illuminate\Http\Request;

class VelocidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Velocidade  $velocidade
     * @return \Illuminate\Http\Response
     */
    public function show(Velocidade $velocidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Velocidade  $velocidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Velocidade $velocidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Velocidade  $velocidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Velocidade $velocidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Velocidade  $velocidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Velocidade $velocidade)
    {
        //
    }

    //vista
    public function subirVelocidades(Request $request)
    {
        return view("velocidades.subirVelocidades");

    }


    //guardar
    public function importarVelocidades(Request $request)
    {

        if(request()->file('velocidades')){
            //importar HOJA 0 plantilla-sistema-reportes
            Excel::import(new MultipleSheetsImportVelocidades, request()->file('velocidades'));

            return back()->with('success','¡Archivo subido correctamente!');



        }

    }

    
}
