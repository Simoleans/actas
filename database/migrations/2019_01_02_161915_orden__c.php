<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdenC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_seguimiento');
            $table->integer('id_user')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_user')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_proveedor')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_proveedor')->references('id')->on('proveedor')->onDelete('cascade');
            $table->string('firma');
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
        Schema::dropIfExists('orden_compra');
    }
}
