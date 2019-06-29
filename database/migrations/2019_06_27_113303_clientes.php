<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            

        Schema::create('clientes', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('id_empresa')->unsigned(); //De uno a uno,  una empresa
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_plan')->unsigned(); //De uno a uno,  un plan
            $table->foreign('id_plan')->references('id')->on('planes')->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
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
        //
    }
}
