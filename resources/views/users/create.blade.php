@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Usuarios"> Usuarios </a></li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Usuario</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
					<h4>Agregar Usuario</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
								<label class="control-label" for="apellido">Nombre completo: *</label>
								<input id="apellido" class="form-control" type="text" name="nombre" value="{{ old('apellido')?old('apellido'):'' }}" placeholder="Nombre Completo" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
								<label class="control-label" for="email">Email: *</label>
								<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut_user')?'has-error':'' }}">
								<label class="control-label" for="rut">RUT: *</label>
								<input id="rut_user" class="form-control rut" type="text" name="rut_user" value="{{ old('rut_user')?old('rut_user'):'' }}" placeholder="RUT" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad_user')?'has-error':'' }}">
								<label class="control-label" for="ciudad_user">Ciudad: *</label>
								<input id="ciudad_user" class="form-control" type="text" name="ciudad_user" value="{{ old('ciudad_user')?old('ciudad_user'):'' }}" placeholder="Ciudad" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono_user')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono: *</label>
								<input id="telefono_user" class="form-control tlf" type="text" name="telefono_user" value="{{ old('telefono_user')?old('telefono_user'):'' }}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
								<label class="control-label" for="direccion_user">Direccion: *</label>
								<input id="direccion_user" class="form-control" type="text" name="direccion_user" value="{{ old('direccion_user')?old('direccion_user'):'' }}" placeholder="Direccion" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
								<label class="control-label" for="password">Contraseña: *</label>
								<input id="password" class="form-control" type="password" name="password" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
								<label class="control-label" for="password_confirmation">Verificar: *</label>
								<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
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
