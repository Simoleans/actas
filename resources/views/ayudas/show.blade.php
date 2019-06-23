@extends('layouts.app')
@section('title','Ayuda - '.config('app.name'))
@section('header','Ayuda')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Ayuda </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
	<section>
    <a class="btn btn-flat btn-default" href="{{ route('ayudas.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-flat btn-success" href="{{ route('ayudas.edit',[$ayuda->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	</section>
<div class="row">
  <div class="col-md-6">
     <section class="perfil">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-header" style="margin-top:0!important">
              <i class="fa fa-user" aria-hidden="true"></i>
              {{ $ayuda->titulo }}
              <small class="pull-right">Registrado: {{ $ayuda->created_at }}</small>
              <span class="clearfix"></span>
            </h2>
          </div>
          <div class="col-md-4">
            <h4>Detalles de la ayuda</h4>
            <p><b>Título: </b> {{$ayuda->titulo}} </p>
            <p><b>Descripción: </b> {{$ayuda->descripcion}} </p>
          </div>
        </div>
      </section>
  </div>

  <div class="col-md-6">
     <section class="perfil">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-header" style="margin-top:0!important">
              <i class="fa fa-user" aria-hidden="true"></i>
              {{ $ayuda->titulo }}
              
              <span class="clearfix"></span>
            </h2>
          </div>
          <div class="col-md-12">
           <div class="video-responsive">
            <iframe  src="https://www.youtube.com/embed/{{$ayuda->video}}" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
          </div>
          </div>
        </div>
      </section>
  </div>
</div>


	

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar ayuda</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('ayudas.destroy',[$ayuda->id])}}" method="POST">
              {{ method_field( 'DELETE' ) }}
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar esta ayuda?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection