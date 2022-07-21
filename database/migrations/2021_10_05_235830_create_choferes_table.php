<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoferesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->id();
            $table->string('nb_chofer');
            $table->string('nb_chofer_a_paterno');
            $table->string('nb_chofer_a_materno')->nullable();
            $table->bigInteger('no_empleado')->unique();
            $table->timestamps();
            $table->boolean('isActive');


            $table->unsignedBigInteger('id_cedis');
            $table->foreign("id_cedis")->references("id")->on("cedis");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choferes');
    }
}
