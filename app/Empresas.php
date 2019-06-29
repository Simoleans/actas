<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{

     public $table = 'empresas';

     protected $fillable = [
          'id_user',
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
       return $this->hasMany('App\Clientes','id_empresa');
    }

     public static function empresa($id)
    {
      return Empresas::where('id_user',$id)->first();
    }
}
