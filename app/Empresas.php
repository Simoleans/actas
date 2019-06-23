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

    public function personas()
    {
       //return $this->belongsTo('App\User','id_user');
       return $this->belongsTo('App\User','id_user');
    }

     public static function empresa($id)
    {
      return Empresas::where('id_user',$id)->first();
    }
}
