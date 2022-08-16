<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion_inicial');
            $table->string('ubicacion_final')->nullable;
            $table->string('descripcion');
            $table->date('fecha_evento');
            $table->time('hora_inicial');
            $table->time('hora_final')->nullable;
            $table->unsignedBigInteger('id_justificacion');
            $table->foreign("id_justificacion")->references("id")->on("justificaciones");

            $table->unsignedBigInteger('id_unidad');
            $table->foreign("id_unidad")->references("id")->on("unidades");

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
        Schema::dropIfExists('detalle_eventos');
    }
}
