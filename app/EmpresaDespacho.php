<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaDespacho extends Model
{
    public $table = 'empresa_despachos';

     protected $fillable = [
          'id_user',
          'r_social',
          'ciudad',
          'contacto',
          'rut',
          'direccion',
          'telefono',
    ];
}
