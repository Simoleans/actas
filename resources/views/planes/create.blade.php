@extends('layouts.app')
@section('title','Plan - '.config('app.name'))
@section('header','Plan')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Plan"> Plan </a></li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Plan</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('planes.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_empresa" value="{{ strtoupper($empresa->id)}}">
					<h4>Agregar Plan</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('id_empresa')?'has-error':'' }}">
									<label class="control-label" for="id_empresa">Empresa: *</label>
									<input id="id_empresa" class="form-control" type="text" name="empresa" value="{{ strtoupper($empresa->r_social)}}"  required readonly="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
									<label class="control-label" for="nombre">Plan: *</label>
									<input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):'' }}" placeholder="Plan" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('fecha_inicio')?'has-error':'' }}">
									<label class="control-label" for="fecha_inicio">Fecha Inicio: *</label>
									<input id="fecha_inicio" class="form-control date" type="text" name="fecha_inicio" value="{{ old('fecha_inicio')?old('fecha_inicio'):'' }}" placeholder="Fecha Inicio" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('fecha_fin')?'has-error':'' }}">
									<label class="control-label" for="fecha_fin">Fecha Final: *</label>
									<input id="fecha_fin" class="form-control date" type="text" name="fecha_fin" value="{{ old('fecha_fin')?old('fecha_fin'):'' }}" placeholder="Fecha Final" required>
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
								<a class="btn btn-flat btn-default" href="{{route('planes.index')}}"><i class="fa fa-reply"></i> Atras</a>
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
