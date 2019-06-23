<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_seguimiento');
            $table->string('tipo_modelo');
            $table->string('producto');
            $table->string('precio_unt');
            $table->string('cantidad');
            $table->string('precio_total');
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
        Schema::dropIfExists('productos_compras');
    }
}
