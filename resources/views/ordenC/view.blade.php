@extends('layouts.app')
@section('title','Orden De Trabajo - '.config('app.name'))
@section('header','Orden De Trabajo')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Orden De Trabajo {{$orden->cod_seguimiento}} </li>
    <li class="active">Ver </li>
  </ol>
@endsection
@section('content')
<section>
    <a class="btn btn-flat btn-default" href="{{ route('ordencompra.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-danger btn-flat" href="{{ route('ordencompra.pdf',[$orden->id])}}"><i class="fa fa-print"></i></a>
    {{-- <a class="btn btn-flat btn-success" href="{{ route('ordentrabajo.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
    @if(!$orden->status)
      <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#delModal"><i class="fa fa-email" aria-hidden="true"></i> Enviar Mail</button>
    @endif
  </section>
  <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Orden De Trabajo '.$orden->cod_seguimiento }}
          <small class="pull-right">Registrado: {{ $orden->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-6">
        <h4>Detalles de la empresa</h4>
        <p><b>Usuario: </b> {{$orden->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($orden->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($orden->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($orden->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($orden->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($orden->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($orden->empresa->direccion)}}</p>
        <p><b>Firmas:</b></p>
        <div class="row">
          <div class="col-md-6"> <img src="{{asset('img/firmas/ordent'.'/'.$orden->firma)}}"></div>
          @if($orden->status)
            <div class="col-md-6"> <img src="{{asset('img/firmas/ordent'.'/'.$orden->firma_receptor)}}"></div>
          @else
            <h2>Sin Confirmar</h2>
          @endif
        </div>
      </div>

      <div class="col-md-6"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$orden->empresa->logo)}}" class="img-responsive">
      </div>
    </div>

   
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Acciones
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Cantidad</th>
          </tr>
         </thead>
         <tbody>
          @foreach($detalles as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->nombre}}</td>
             <td class="text-center">{{$a->cantidad}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
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
            <form class="col-md-8 col-md-offset-2" action="{{ route('ordentrabajo.mail')}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$orden->id}}">
             <label class="control-label">Email: </label>
             <input type="email" name="email" class="form-control">

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

