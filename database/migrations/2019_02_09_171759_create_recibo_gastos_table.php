<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_seguimiento');
            $table->integer('id_user')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('recibe');
            $table->string('firma');
            $table->string('firma_receptor')->nullable();
            $table->string('observaciones')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('recibo_gastos');
    }
}
