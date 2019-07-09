<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaClientes extends Model
{
     public $table = 'empresa_clientes';

     protected $fillable = [
          'id_user',
          'id_empresa',
          'id_empresa_cliente',
          'id_cliente',
      ];

     public function cliente()
    {
        return $this->belongsTo('App\Clientes','id_cliente');
    }
}
