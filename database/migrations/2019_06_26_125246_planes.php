<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Planes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa')->unsigned(); //De uno a uno,  una empresa
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('nombre');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
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
        Schema::dropIfExists('planes');
    }
}
