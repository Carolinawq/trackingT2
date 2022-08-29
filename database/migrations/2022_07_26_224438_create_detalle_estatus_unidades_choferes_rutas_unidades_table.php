<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleEstatusUnidadesChoferesRutasUnidadesTable extends Migration
{

    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_est_unid_chof_rut_unids', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_chofer')->nullable();
            $table->foreign("id_chofer")->references("id")->on("choferes");

            $table->unsignedBigInteger('id_ruta')->nullable();
            $table->foreign("id_ruta")->references("id")->on("rutas");

            $table->unsignedBigInteger('id_unidad');
            $table->foreign("id_unidad")->references("id")->on("unidades");

            $table->unsignedBigInteger('id_estatus_unidades');
            $table->foreign("id_estatus_unidades")->references("id")->on("estatus_unidades");

            $table->integer('no_vuelta')->nullable();
            $table->integer('no_dias_consecutivos')->nullable();
            $table->date('fecha_ruta');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_estatus_unidades_choferes_rutas_unidades');
    }
}
