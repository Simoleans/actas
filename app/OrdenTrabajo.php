<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participantes;

class OrdenTrabajo extends Model
{
    public $table = 'orden_trabajo';

    //protected $fillable = ['id_empresa'];

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }

      public function participantes($codigo)
     {
        return Participantes::where('codigo_acta',$codigo)->get();
     }
}
