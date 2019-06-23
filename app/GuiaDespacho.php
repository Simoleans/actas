<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaDespacho extends Model
{
    
     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

     public function empresa_receptora()
     {
     	 return $this->belongsTo("App\EmpresaDespacho", "id_empresa_despacho");
     }
}
