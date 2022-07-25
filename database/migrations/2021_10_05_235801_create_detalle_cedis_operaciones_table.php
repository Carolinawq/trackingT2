<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCedisOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cedis_operaciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cedis');
            $table->foreign("id_cedis")->references("id")->on("cedis");

            $table->unsignedBigInteger('id_operacion');
            $table->foreign("id_operacion")->references("id")->on("operaciones");

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
        Schema::dropIfExists('detalle_cedis_operaciones');
    }
}
