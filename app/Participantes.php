<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    public $table = 'participantes';

    //protected $fillable = ['codigo_acta','nombre','apellido','cargo','firma'];

    public function clientes()
    {
        return $this->belongsTo('App\Clientes', 'id_cliente');

    }

    public function acta()
    {
        return $this->belongsTo('App\Actas', 'id_acta');
    }

    public function empresa()
    {
        return $this->hasOne('App\Empresas', 'id_empresa');
    }

    public function scopeEmpresa($query, $empresa)
    {
        if ($empresa) {
            return $query->where('id_empresa', $empresa);
        }
    }

    public function scopePlan($query, $plan)
    {
        if ($plan) {
            return $query->where('id_plan', $plan);
        }
    }

    public function scopeCliente($query, $cliente)
    {
        if ($cliente) {
            return $query->where('id_cliente', $cliente);
        }
    }
}
