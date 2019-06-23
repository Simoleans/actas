@extends('layouts.app')
@section('title','Guia De Despacho - '.config('app.name'))
@section('header','Guia De Despacho')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Guia De Despacho {{$guia->cod_seguimiento}} </li>
    <li class="active">Ver </li>
  </ol>
@endsection
@section('content')
<section>
    <a class="btn btn-flat btn-default" href="{{ route('guiadespacho.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-danger btn-flat" href="{{ route('guiadespacho.pdf',[$guia->id])}}"><i class="fa fa-print"></i></a> 
    {{-- <a class="btn btn-flat btn-success" href="{{ route('guiadespacho.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
    @if(!$guia->status)
      <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#delModal"><i class="fa fa-email" aria-hidden="true"></i> Enviar Mail</button>
    @endif
  </section>
  <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Guia De Despacho '.$guia->cod_seguimiento }}
          <small class="pull-right">Registrado: {{ $guia->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <h3>Recibe: {{strtoupper($guia->recibe)}}</h3>
      <div class="col-md-6">
        <h4>Detalles de la empresa</h4>
        <p><b>Usuario: </b> {{$guia->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($guia->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($guia->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($guia->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($guia->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($guia->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($guia->empresa->direccion)}}</p>
        <p><b>Firmas:</b></p>
        <div class="row">
          <div class="col-md-6"> <img src="{{asset('img/firmas/guiad'.'/'.$guia->firma)}}"></div>
          @if($guia->status)
            <div class="col-md-6"> <img src="{{asset('img/firmas/guiad'.'/'.$guia->firma_receptor)}}"></div>
          @else
            <h2>Sin Confirmar</h2>
          @endif
        </div>
      </div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$guia->empresa->logo)}}" class="img-responsive">
      </div>
    </div>
<br>
    <div class="row">
      <div class="col-md-6">
        <h4>Detalles de la empresa receptora</h4>
        <p><b>Empresa: </b> {{strtoupper($guia->empresa_receptora->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($guia->empresa_receptora->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($guia->empresa_receptora->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($guia->empresa_receptora->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($guia->empresa_receptora->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($guia->empresa_receptora->direccion)}}</p>
      </div>
    </div>
<br>
   
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Productos
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Tipo Modelo</th>
            <th class="text-center">Producto</th>
            <th class="text-center">Precio</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Total</th>
          </tr>
         </thead>
         <tbody>
          @foreach($productos as $a)
           <tr>
             <td class="text-center">{{$loop->index+1}}</td>
             <td class="text-center">{{$a->tipo_modelo}}</td>
             <td class="text-center">{{$a->producto}}</td>
             <td class="text-center">{{$a->precio_unt}}</td>
             <td class="text-center">{{$a->cantidad}}</td>
             <td class="text-center">{{number_format($a->precio_total)}}</td>
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
            <form class="col-md-8 col-md-offset-2" action="{{ route('guiadespacho.mail')}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$guia->id}}">
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

