<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nb_unidad');

            $table->unsignedBigInteger('id_estatus');
            $table->foreign("id_estatus")->references("id")->on("estatus_unidades");

            $table->unsignedBigInteger('id_evento');
            $table->foreign("id_evento")->references("id")->on("eventos");

            

            $table->boolean('isActive');


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
        Schema::dropIfExists('unidades');
    }
}
