<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientesEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_cliente')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('r_social');
            $table->string('ciudad');
            $table->string('contacto');
            $table->string('rut');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('telefono_casa')->nullable();
            $table->string('giro_comercial')->nullable();
            $table->string('logo');
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
        Schema::dropIfExists('clientes_empresa');
    }
}
