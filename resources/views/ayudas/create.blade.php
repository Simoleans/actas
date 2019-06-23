@extends('layouts.app')
@section('title','Ayuda - '.config('app.name'))
@section('header','Ayuda')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('ayudas.index')}}" title="Ayuda"> Ayudas </a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
			</div>
		</div>

		<div class="row">
	  	<div class="col-md-7 col-md-offset-2">
	    	<div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-question"></i> Registrar Ayuda</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('ayudas.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('titulo')?'has-error':'' }}">
								<label class="control-label" for="titulo">Título: *</label>
								<input id="titulo" class="form-control" type="text" name="titulo" value="{{ old('titulo')?old('titulo'):'' }}" placeholder="Título" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('descripcion')?'has-error':'' }}">
								<label class="control-label" for="descripcion">Descripcion: *</label>
								<textarea id="descripcion" class="form-control"  name="descripcion" value="{{ old('descripcion')?old('descripcion'):'' }}" placeholder="Descripcion" required></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('video')?'has-error':'' }}">
								<label class="control-label" for="rut">Video: *</label>
								<input id="video" class="form-control" type="text" name="video" value="{{ old('video')?old('video'):'' }}" placeholder="https://www.youtube.com/embed/<ID>" required>
							</div>
						</div>
						

					@if (count($errors) > 0)
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        @endif

					<div class="form-group col-md-12">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection
