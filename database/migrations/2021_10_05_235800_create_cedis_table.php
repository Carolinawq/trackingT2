<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cedis', function (Blueprint $table) {
            $table->id();
            $table->string('nb_cedis')->unique();
            $table->string('nb_ubicacion');
            $table->timestamps();
            $table->boolean('isActive');

            
            $table->unsignedBigInteger('id_operacion');
            $table->foreign('id_operacion')->references('id')->on('operaciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cedis');
    }
}
