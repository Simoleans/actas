<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'id_user',
          'nombre',
          'email',
          'rut_user',
          'ciudad_user',
          'telefono_user',
          'direccion_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function empresa()
    {
        //return $this->hasMany('App\Empresas');

       return $this->hasMany('App\Empresas','id_user');
    }

    public function users()
    {
        //return $this->hasMany('App\Empresas');

       return $this->hasMany('App\User','id_user');
    }

    public function ordenes()
    {
        return $this->hasMany('App\OrdenC');

        //return $this->hasMany('App\OrdenC','id_user');
    }
}
