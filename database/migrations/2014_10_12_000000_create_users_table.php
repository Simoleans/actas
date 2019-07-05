<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->nullable(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_user_sucursal')->unsigned()->nullable(); //De uno a muchos,  una empresa,  muchos usuarios
            $table->foreign('id_user_sucursal')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombre');
            $table->string('email', 190)->unique();
            $table->string('rut_user');
            $table->string('ciudad_user');
            $table->string('telefono_user');
            $table->string('direccion_user');
            $table->string('password');
            $table->string('rol')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
