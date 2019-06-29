<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participantes;
use App\Acciones;

class Actas extends Model
{
     public $table = 'actas';

     protected $fillable = ['codigo','id_empresa','id_user','observaciones'];

     public function total($id)
     {
     	return Participantes::where('id_acta',$id)->count();
     }

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }

     public function participantes($id)
     {
     	return Participantes::where('id_acta',$id)->get();
     }


      public function acciones($codigo)
     {
     	return Acciones::where('codigo_acta',$codigo)->get();
     }

     public function observaciones($codigo)
     {
          return Observacion::where('codigo_acta',$codigo)->get();
     }
}
