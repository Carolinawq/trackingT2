<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCedisUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cedis_unidades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cedis');
            $table->foreign("id_cedis")->references("id")->on("cedis");

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
        Schema::dropIfExists('detalle_cedis_unidades');
    }
}
