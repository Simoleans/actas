<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public $table = 'clientes';

     protected $fillable = ['nombre','apellido','email','id_empresa','id_plan','telefono','direccion','rut'];
}
