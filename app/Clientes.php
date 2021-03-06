<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public $table = 'clientes';

    protected $fillable = ['nombre', 'apellido', 'email', 'id_empresa', 'id_plan', 'id_user', 'telefono', 'direccion', 'rut'];

    public function plan()
    {
        return $this->belongsTo('App\Planes', 'id_plan');
    }

    public function empresa()
    {
        return $this->hasOne('App\EmpresaClientes');
    }
}
