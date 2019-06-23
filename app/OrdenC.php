<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenC extends Model
{
     public $table = 'orden_compra';

     protected $fillable = ['cod_seguimiento','id_user','id_proveedor','id_empresa','firma'];

     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

     public function proveedor()
     {
     	return $this->belongsTo("App\Proveedor", "id_proveedor");
     }
}
