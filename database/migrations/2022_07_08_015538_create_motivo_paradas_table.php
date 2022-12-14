<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivoParadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_paradas', function (Blueprint $table) {
            $table->id();
            $table->string('nb_motivo_parada');
            $table->boolean('isActive');

            $table->unsignedBigInteger('id_parada');
            $table->foreign("id_parada")->references("id")->on("paradas");

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
        Schema::dropIfExists('motivo_paradas');
    }
}
