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
            $table->integer('id_acta')->unsigned(); //De uno a uno,  una empresa
            $table->foreign('id_acta')->references('id')->on('actas')->onDelete('cascade');
            $table->integer('id_cliente')->unsigned(); //De uno a uno,  una empresa
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('firma')->nullable();
            $table->integer('status')->default(0);
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
