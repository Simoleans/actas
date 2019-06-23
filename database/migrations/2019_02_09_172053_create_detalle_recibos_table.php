<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_recibos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_seguimiento');
            $table->string('concepto');
            $table->string('cantidad');
            $table->string('cuenta');
            $table->string('transferencia_efectivo');
            $table->string('adicional')->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('detalle_recibos');
    }
}
