<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVueltasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vueltas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('no_vuelta');

            $table->unsignedBigInteger('id_chofer');
            $table->foreign("id_chofer")->references("id")->on("choferes");

            $table->unsignedBigInteger('id_ruta');
            $table->foreign("id_ruta")->references("id")->on("rutas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vueltas');
    }
}
