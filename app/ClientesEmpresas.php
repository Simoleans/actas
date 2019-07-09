<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientesEmpresas extends Model
{
    public $table = 'clientes_empresa';

     protected $fillable = [
          'id_user',
          'id_empresa',
          'r_social',
          'ciudad',
          'contacto',
          'rut',
          'direccion',
          'telefono',
          'telefono_casa',
          'giro_comercial',
          'logo',
    ];

    public function user()
    {
       //return $this->belongsTo('App\User','id_user');
       return $this->belongsTo('App\User','id_user');
    }

    public function clientes()
    {
       //return $this->belongsTo('App\User','id_user');
       return $this->belongsTo('App\ClientesEmpresas','id_cliente')->where('status',0);
    }
}
