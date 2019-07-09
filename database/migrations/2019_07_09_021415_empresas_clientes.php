<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresasClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_cliente')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('id_empresa_cliente')->unsigned(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_empresa_cliente')->references('id')->on('empresa_clientes')->onDelete('cascade');
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
        Schema::dropIfExists('empresa_clientes');
    }
}
