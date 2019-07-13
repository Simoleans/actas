<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->integer('id_user')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
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
        Schema::dropIfExists('actas');
    }
}
