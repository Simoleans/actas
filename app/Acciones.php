<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    public $table = 'acciones';

     protected $fillable = ['codigo_acta','accion'];
}
