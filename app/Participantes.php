<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    public $table = 'participantes';

     protected $fillable = ['codigo_acta','nombre','apellido','cargo','firma'];
}
