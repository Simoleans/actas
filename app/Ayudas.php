<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayudas extends Model
{
      public $table = 'ayudas';

     protected $fillable = ['titulo','descripcion','video'];
}
