<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboGastos extends Model
{
     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

}
