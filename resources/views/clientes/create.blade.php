@extends('layouts.app')
@section('title','Clientes - '.config('app.name'))
@section('header','Clientes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Clientes"> Clientes </a></li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Clientes</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_empresa" value="{{ strtoupper($empresa->id)}}">
					<h4>Agregar Cliente</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('id_empresa')?'has-error':'' }}">
								<label class="control-label" for="id_empresa">Empresa: *</label>
								<input id="id_empresa" class="form-control" type="text" name="empresa" value="{{ strtoupper($empresa->r_social)}}"  required readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
								<label class="control-label" for="nombre">Nombre: *</label>
								<input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):'' }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
								<label class="control-label" for="apellido">Apellido: *</label>
								<input id="apellido" class="form-control" type="text" name="apellido" value="{{ old('apellido')?old('apellido'):'' }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
								<label class="control-label" for="email">Email: *</label>
								<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Contacto" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut')?'has-error':'' }}">
								<label class="control-label" for="rut">RUT: *</label>
								
								  <input type="text" id="rut" name="rut" required  placeholder="Ingrese RUT" class="form-control rut" maxlength="12">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono: *</label>
								<input id="telefono" class="form-control tlf" type="text" name="telefono" value="{{ old('telefono')?old('telefono'):'' }}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('id_plan')?'has-error':'' }}">
								<label class="control-label" for="id_plan">Planes: *</label>
								<select class="form-control" name="id_plan" required="">
									<option value="">Seleccione...</option>
									@foreach($planes as $p)
										<option value="{{$p->id}}">{{$p->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
								<label class="control-label" for="ciudad">Direccion: *</label>
								<textarea class="form-control" name="direccion" required=""></textarea>
							</div>
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
					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection
