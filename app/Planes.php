<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
	public $table = 'planes';
    protected $fillable = ['id_empresa','nombre','fecha_inicio','fecha_fin'];
}
