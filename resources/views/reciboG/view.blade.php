@extends('layouts.app')
@section('title','Recibo De Gasto - '.config('app.name'))
@section('header','Recibo De Gasto')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Recibo De Gasto {{$recibo->cod_seguimiento}} </li>
    <li class="active">Ver </li>
  </ol>
@endsection
@section('content')
<section>
    <a class="btn btn-flat btn-default" href="{{ route('recibogastos.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-danger btn-flat" href="{{ route('recibogastos.pdf',[$recibo->id])}}"><i class="fa fa-print"></i></a> 
    {{-- <a class="btn btn-flat btn-success" href="{{ route('reciboentrega.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
    @if(!$recibo->status)
      <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#delModal"><i class="fa fa-email" aria-hidden="true"></i> Enviar Mail</button>
    @endif
  </section>
  <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Recibo De Gasto '.$recibo->cod_seguimiento }}
          <small class="pull-right">Registrado: {{ $recibo->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <h3>Recibe: {{$recibo->recibe}}</h3>
      <div class="col-md-6">
        <h4>Detalles de la empresa</h4>
        <p><b>Usuario: </b> {{$recibo->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($recibo->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($recibo->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($recibo->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($recibo->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($recibo->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($recibo->empresa->direccion)}}</p>
        <p><b>Firmas:</b></p>
        <div class="row">
          <div class="col-md-6"> <img src="{{asset('img/firmas/recibog'.'/'.$recibo->firma)}}"></div>
          @if($recibo->status)
            <div class="col-md-6"> <img src="{{asset('img/firmas/recibog'.'/'.$recibo->firma_receptor)}}"></div>
          @else
            <h2>Sin Confirmar</h2>
          @endif
        </div>
      </div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$recibo->empresa->logo)}}" class="img-responsive">
      </div>
    </div>
<br>
   
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Detalles De Recibo
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-6">
          <p><b>Concepto: </b>{{strtoupper($detalle->concepto)}}</p>
          <p><b>Cantidad:</b> {{number_format($detalle->cantidad)}}</p>
          <p><b>Cuenta:</b> {{$detalle->cuenta}}</p>
          <p><b>Tipo De Pago:</b> {{strtoupper($detalle->transferencia_efectivo)}}</p>
          <p><b>Adicional:</b> {{strtoupper($detalle->adicional?$detalle->adicional:'N/T')}}</p>
          <p><b>Observaciones:</b> {{strtoupper($detalle->observaciones?$detalle->observaciones:'N/T')}}</p>
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
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('recibogastos.mail')}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$recibo->id}}">
             <label class="control-label">Email: </label>
             <input type="email" name="email" class="form-control">
                <br>
              <center>
                <button class="btn btn-flat btn-danger" type="submit">Enviar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

