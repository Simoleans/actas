@extends('layouts.app')
@section('title','Empresa - '.config('app.name'))
@section('header','Empresa')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Empresas"> Empresa </a></li>
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
		        <h3 class="box-title"><i class="fa fa-industry"></i> Registrar Empresa</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<h4>Agregar Empresa</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('r_social')?'has-error':'' }}">
								<label class="control-label" for="r_social">Razon Social: *</label>
								<input id="r_social" class="form-control" type="text" name="r_social" value="{{ old('r_social')?old('r_social'):'' }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Contacto: *</label>
								<input id="contacto" class="form-control" type="text" name="contacto" value="{{ old('contacto')?old('contacto'):'' }}" placeholder="Contacto" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut')?'has-error':'' }}">
								<label class="control-label" for="rut">RUT: *</label>
								<input id="rut" class="form-control rut" type="text" name="rut" value="{{ old('rut')?old('rut'):'' }}" placeholder="RUT" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
								<label class="control-label" for="ciudad">Ciudad: *</label>
								<input id="ciudad" class="form-control" type="text" name="ciudad" value="{{ old('ciudad')?old('ciudad'):'' }}" placeholder="Ciudad" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono: *</label>
								<input id="telefono" class="form-control tlf" type="text" name="telefono" value="{{ old('telefono')?old('telefono_user'):'' }}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono De Casa: </label>
								<input id="telefono_casa" class="form-control" type="text" name="telefono_casa" value="{{ old('telefono_casa')?old('telefono_casa'):'' }}" placeholder="Telefono De Casa" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
								<label class="control-label" for="direccion_user">Direccion: *</label>
								<input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion')?old('direccion'):'' }}" placeholder="Direccion" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('giro_comercial')?'has-error':'' }}">
								<label class="control-label" for="giro">Giro Comercial: *</label>
								<input id="giro_comercial" class="form-control" type="text" name="giro_comercial" value="{{ old('giro_comercial')?old('giro_comercial'):'' }}" placeholder="Giro Comercial" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('logo')?'has-error':'' }}">
								<label class="control-label" for="logo">Logo de la empresa: *</label>
								<input id="logo" class="form-control img_upload" type="file" name="logo" required>
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

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$(".img_upload").fileinput({
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            browseLabel: "Agregar Foto",
            browseIcon: "<i class=\"fa fa-file-image-o\"></i> ",
            showRemove: false,
            showUpload: false,
            showCancel: false,
            showClose: false,
            dropZoneEnabled: false
        });
	});
</script>
@endsection