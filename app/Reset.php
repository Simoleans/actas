<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    public $table = 'reset';

   protected $fillable = [
        'token','email','status'];
}
