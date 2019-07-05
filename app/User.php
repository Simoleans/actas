<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Empresas as Empresas;

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
          'id_user_sucursal',
          'nombre',
          'email',
          'rut_user',
          'ciudad_user',
          'telefono_user',
          'direccion_user',
          'rol',
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

       //return $this->hasMany('App\Empresas','id_user');
      return $this->hasOne('App\Empresas','id_user');
    }

    public function users()
    {
        //return $this->hasMany('App\Empresas');

       return $this->hasMany('App\User','id_user');
    }

    public function users_belong()
    {
      return $this->belongsTo('App\User','id_user');
    }

    public function sucursal()
    {
      return $this->hasMany('App\User','id_user_sucursal');
    }

    public function belong_sucursal()
    {
      return $this->belongsTo('App\User','id_user_sucursal');
    }

    public function ordenes()
    {
        return $this->hasMany('App\OrdenC');

        //return $this->hasMany('App\OrdenC','id_user');
    }

    public function empresaExist($id)
    {
      //dd($user->users_belong->empresa); // empresa de un usuario registrado por el admind e la empresa 2do nivel

       //dd($user->belong_sucursal->users_belong->empresa); // empresa de una sucursal, el que registra el usuario que registro el admin, el tercer nivel
      $user = User::findOrfail($id);

      
      if (!$user->id_user_sucursal && !$user->id_user) {
          $empresa = false;
      }elseif (!$user->id_user_sucursal && $user->id_user) {
          $empresa = $user->users_belong->empresa;
      }elseif ($user->id_user_sucursal && !$user->id_user) {
        $empresa = $user->belong_sucursal->users_belong->empresa;
      }

      //dd($empresa->id);

      return $empresa;

    }

    public function exitsEmp($id)
    {
        $empresa = Empresas::where('id_user',$id)->exists();

        //dd($empresa);

        return $empresa;
    }
}
