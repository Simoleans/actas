<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
     public $table = 'fotos';

     protected $fillable = ['codigo_acta','foto'];
}
