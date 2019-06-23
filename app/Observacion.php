<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
     public $table = 'observaciones';

     protected $fillable = ['codigo_acta','observacion'];
}
