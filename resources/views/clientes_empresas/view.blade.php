@extends('layouts.app')
@section('title','Empresa - '.config('app.name'))
@section('header','Empresa')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Empresa {{strtoupper($empresaCliente->r_social)}} </li>
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
          {{ 'Empresa '.strtoupper($empresaCliente->r_social) }}
          <small class="pull-right">Registrado: {{ $empresaCliente->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-6">
        <h4>Detalles de la empresa</h4>
        <p><b>Empresa: </b> {{strtoupper($empresaCliente->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($empresaCliente->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($empresaCliente->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($empresaCliente->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($empresaCliente->telefono)}}</p>
        <p><b>Telefono De Casa: </b> {{$empresaCliente->telefono_casa}}</p>
        <p><b>Direccion: </b> {{strtoupper($empresaCliente->direccion)}}</p>
        <p><b>Giro Comercial: </b>{{ strtoupper($empresaCliente->giro_comercial) }}</p>
      </div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$empresaCliente->logo)}}" class="img-responsive">
      </div>
    </div>
  </section>

   <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-users" aria-hidden="true"></i>
          Los clientes de {{strtoupper($empresaCliente->r_social) }}
       {{--    <small class="pull-right">Registrado: {{ $empresaCliente->created_at }}</small> --}}
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table data-table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">RUT</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Plan</th>
                <th class="text-center">Accion</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($clienteEmpresa as $d)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{strtoupper($d->cliente->nombre)}}</td>
                  <td>{{strtoupper($d->cliente->apellido)}}</td>
                  <td>{{strtoupper($d->cliente->rut)}}</td>
                  <td>{{strtoupper($d->cliente->email)}}</td>
                  <td>{{$d->cliente->telefono}}</td>
                  <td>{{strtoupper($d->cliente->direccion)}}</td>
                  <td>{{$d->cliente->plan->nombre}}</td>
                  <td>
          {{--     <a class="btn btn-primary btn-flat btn-sm" href="{{ route('clientes.show',[$d->id])}}"><i class="fa fa-search"></i></a> --}}
                    <a href="{{route('clientes.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
                  </td>
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
          <h4 class="modal-title" id="delModalLabel">Agregar cliente a {{strtoupper($empresaCliente->r_social)}}</h4>
        </div>
        <div class="modal-body">
          <div class="content">
            <div class="row">
              <form id="store_cliente_empresa" action="{{ route('clientese.store') }}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_empresa_cliente" value="{{$empresaCliente->id}}">
              <input type="hidden" name="id_empresa" value="{{$empresa->id}}">
              <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
              {{ method_field( 'POST' ) }}
              {{ csrf_field() }}
              <h4>Agregar Cliente</h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('r_social')?'has-error':'' }}">
                    <label class="control-label" for="r_social">Cliente: *</label>
                    <select name="id_cliente" id="" class="form-control">
                      <option value="">Seleccione...</option>
                      @foreach($clientes as $c)
                        <option value="{{$c->id}}">{{$c->rut.' - '.strtoupper($c->nombre.' '.$c->apellido)}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>     
              </div>
              <div class="form-group text-right">
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

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $("#store_cliente_empresa").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: '{{ route('store.clienteEmpresa') }}',
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
      })
      .done(function(data) {
        Swal.fire({
          type: data.type,
          title: data.msg,
        })
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    });
  });//fin document ready
</script>
@endsection

