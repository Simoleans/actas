<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id_user')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
