@extends('layouts.app')
@section('title','Empresa - '.config('app.name'))
@section('header','Empresa')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Empresas"> Empresa </a></li>
	  <li class="active">Editar</li>
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
		        <h3 class="box-title"><i class="fa fa-industry"></i> Editar Empresa</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('empresas.update',['id' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'PUT' ) }}
					{{ csrf_field() }}
					<h4>Editar Empresa</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('r_social')?'has-error':'' }}">
								<label class="control-label" for="r_social">Razon Social: *</label>
								<input id="r_social" class="form-control" type="text" name="r_social" value="{{ $empresa->r_social }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Contacto: *</label>
								<input id="contacto" class="form-control" type="text" name="contacto" value="{{ $empresa->contacto }}" placeholder="Contacto" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut')?'has-error':'' }}">
								<label class="control-label" for="rut">RUT: *</label>
								<input id="rut" class="form-control rut" type="text" name="rut" value="{{ $empresa->rut }}" placeholder="RUT" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
								<label class="control-label" for="ciudad">Ciudad: *</label>
								<input id="ciudad" class="form-control" type="text" name="ciudad" value="{{ $empresa->ciudad }}" placeholder="Ciudad" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono: *</label>
								<input id="telefono" class="form-control tlf" type="text" name="telefono" value="{{ $empresa->telefono}}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono De Casa: </label>
								<input id="telefono_casa" class="form-control" type="text" name="telefono_casa" value="{{ $empresa->telefono_casa}}" placeholder="Telefono De Casa" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
								<label class="control-label" for="direccion_user">Direccion: *</label>
								<input id="direccion" class="form-control" type="text" name="direccion" value="{{ $empresa->direccion }}" placeholder="Direccion" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('giro_comercial')?'has-error':'' }}">
								<label class="control-label" for="giro">Giro Comercial: *</label>
								<input id="giro_comercial" class="form-control" type="text" name="giro_comercial" value="{{ $empresa->giro_comercial }}" placeholder="Giro Comercial" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('logo')?'has-error':'' }}">
								<label class="control-label" for="logo">Logo de la empresa: *</label>
								<input class="form-control img_upload_edit" id="input-20" type="file" name="logo" >
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
						<a class="btn btn-flat btn-default" href="{{route('empresas.index')}}"><i class="fa fa-reply"></i> Atras</a>
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
        var url = "{{ asset("img/empresas/$empresa->logo")  }}";
          $(".img_upload_edit").fileinput({
            theme: "fa",
            browseClass: "btn btn-primary btn-block",
            initialPreview: [url],
            initialPreviewAsData: true,
            browseLabel: "Agregar Foto",
            browseIcon: "<i class=\"fa fa-file-image-o\"></i> ",
            showCaption: false,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            showClose: false,
            initialPreviewConfig: [
            {caption: "{{$empresa->logo}}", downloadUrl: url, width: "120px", key: "{{$empresa->id}}"}
        ],
        });
      });
</script>
@endsection
