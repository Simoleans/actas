<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proveedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('razon_social');
            $table->string('ciudad');
            $table->string('contacto');
            $table->string('rut_proveedor');
            $table->string('direccion_proveedor');
            $table->string('telefono_proveedor');
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
        Schema::dropIfExists('proveedor');
    }
}
