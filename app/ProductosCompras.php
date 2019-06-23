<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductosCompras extends Model
{
     public $table = 'productos_compras';

     protected $fillable = ['cod_seguimiento','tipo_modelo','producto','precio_unt','cantidad','precio_total'];
}
