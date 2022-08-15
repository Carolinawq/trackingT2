<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleParadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_paradas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_motivo_parada');
            $table->foreign("id_motivo_parada")->references("id")->on("motivo_paradas");

            $table->unsignedBigInteger('id_unidad');
            $table->foreign("id_unidad")->references("id")->on("unidades");

            $table->string('ubicacion');
            $table->date('fecha_parada');

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
        Schema::dropIfExists('detalle_paradas');
    }
}
