@extends('layouts.app')
@section('title','Empresa - '.config('app.name'))
@section('header','Empresa')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Empresa {{strtoupper($empresa->r_social)}} </li>
    <li class="active">Ver </li>
  </ol>
@endsection
@section('content')
<section>
    <a class="btn btn-flat btn-default" href="{{ route('empresas.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    {{-- <a class="btn btn-flat btn-success" href="{{ route('guiaentrega.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
      <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#delModal"><i class="fa fa-email" aria-hidden="true"></i>Agregar Cliente</button>
  </section>
  <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Empresa '.strtoupper($empresa->r_social) }}
          <small class="pull-right">Registrado: {{ $empresa->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-6">
        <h4>Detalles de la empresa</h4>
        <p><b>Empresa: </b> {{strtoupper($empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($empresa->telefono)}}</p>
        <p><b>Telefono De Casa: </b> {{$empresa->telefono_casa}}</p>
        <p><b>Direccion: </b> {{strtoupper($empresa->direccion)}}</p>
        <p><b>Giro Comercial: </b>{{ strtoupper($empresa->giro_comercial) }}</p>
      </div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$empresa->logo)}}" class="img-responsive">
      </div>
    </div>
   
  </section>

  <div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">¿Mandar Email?</h4>
        </div>
        <div class="modal-body">
          <div class="content">
            <div class="row">
              <form class="" action="{{ route('clientese.store') }}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_empresa_cliente" value="{{Auth::user()->id}}">
              {{ method_field( 'POST' ) }}
              {{ csrf_field() }}
              <h4>Agregar Cliente</h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('r_social')?'has-error':'' }}">
                    <label class="control-label" for="r_social">Cliente: *</label>
                    <select name="id_cliente" id="" class="form-control">
                      <option value="">Seleccione...</option>
                      <option value=""></option>
                    </select>
                  </div>
                </div>     
              </div>
              <div class="form-group text-right">
                <a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
                <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

