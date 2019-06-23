<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participantes;
use App\Acciones;

class Actas extends Model
{
     public $table = 'actas';

     protected $fillable = ['codigo','id_empresa','id_user','observaciones'];

     public function total($codigo)
     {
     	return Participantes::where('codigo_acta',$codigo)->count();
     }

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

      public function acciones($codigo)
     {
     	return Acciones::where('codigo_acta',$codigo)->get();
     }
}
