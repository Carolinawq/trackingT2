<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nb_evento');
            $table->time('hora')->nullable();
            $table->date('fecha');
            $table->string('ubicacion');
            $table->timestamps();

            $table->unsignedBigInteger('id_justificacion');
            $table->foreign("id_justificacion")->references("id")->on("justificaciones");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
