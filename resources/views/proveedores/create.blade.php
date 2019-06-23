@extends('layouts.app')
@section('title','Proveedores - '.config('app.name'))
@section('header','Proveedores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Proveedores"> Proveedores </a></li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Proveedor</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('proveedor.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<h4>Agregar Proveedor</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">Razon Social: *</label>
								<input id="razon_social" class="form-control" type="text" name="razon_social" value="{{ old('razon_social')?old('razon_social'):'' }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Contacto: *</label>
								<input id="contacto" class="form-control" type="text" name="contacto" value="{{ old('contacto')?old('contacto'):'' }}" placeholder="Contacto" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut_proveedor')?'has-error':'' }}">
								<label class="control-label" for="rut_proveedor">RUT: *</label>
								
								  <input type="text" id="rut" name="rut_proveedor" required  placeholder="Ingrese RUT" class="form-control rut" maxlength="12">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
								<label class="control-label" for="ciudad">Ciudad: *</label>
								<input id="ciudad" class="form-control" type="text" name="ciudad" value="{{ old('ciudad')?old('ciudad'):'' }}" placeholder="Ciudad" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono_proveedor')?'has-error':'' }}">
								<label class="control-label" for="telefono_proveedor_user">Telefono: *</label>
								<input id="telefono_proveedor" class="form-control tlf" type="text" name="telefono_proveedor" value="{{ old('telefono_proveedor')?old('telefono_proveedor'):'' }}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('direccion_proveedor')?'has-error':'' }}">
								<label class="control-label" for="direccion_proveedor">Direccion: *</label>
								<input id="direccion_proveedor" class="form-control" type="text" name="direccion_proveedor" value="{{ old('direccion_proveedor')?old('direccion_proveedor'):'' }}" placeholder="Direccion" required>
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
