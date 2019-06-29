<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_acta'); //acta id
            $table->integer('id_empresa')->unsigned(); //De uno a uno,  una empresa
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut');
            $table->string('cargo');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('firma')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('participantes');
    }
}
